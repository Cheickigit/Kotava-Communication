<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use App\Models\Actualite;
use App\Models\User;
// use App\Models\Lead; // Commenté car le modèle n'existe pas encore
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord principal
     */
    public function index()
    {
        $user = Auth::user();

        // Statistiques principales (sans team_id)
        $stats = [
            'total_realisations' => Realisation::count(),
            'total_actualites' => Actualite::count(),
            'total_users' => User::count(),
            'total_leads' => 0,
            'realisations_publiees' => Realisation::where('published', true)->count(),
            'actualites_publiees' => Actualite::where('statut', 'publié')->count(),
            'realisations_en_cours' => 0,
            'leads_nouveaux' => 0,
            // Données pour le Dashboard.vue existant
            'totalUsers' => User::count(),
            'adminCount' => User::where('role', 'admin')->count(),
            'managerCount' => User::where('role', 'manager')->count(),
            'employeeCount' => User::where('role', 'employee')->count(),
            'userRole' => $user->role ?? 'admin',
        ];

        // Réalisations récentes
        $recentRealisations = Realisation::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($realisation) {
                return [
                    'id' => $realisation->id,
                    'titre' => $realisation->titre ?? $realisation->title ?? 'Sans titre',
                    'client' => $realisation->client ?? 'N/A',
                    // 'status' => $realisation->status ?? 'N/A', // Colonne n'existe pas
                    'published' => $realisation->published ?? false,
                    'created_at' => $realisation->created_at->format('d/m/Y'),
                    'user' => $realisation->user ? [
                        'name' => $realisation->user->name,
                    ] : null,
                ];
            });

        // Actualités récentes
        $recentActualites = Actualite::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($actualite) {
                return [
                    'id' => $actualite->id,
                    'titre' => $actualite->titre ?? $actualite->title ?? 'Sans titre',
                    'statut' => $actualite->statut ?? 'brouillon',
                    'created_at' => $actualite->created_at->format('d/m/Y'),
                    'user' => $actualite->user ? [
                        'name' => $actualite->user->name,
                    ] : null,
                ];
            });

        // Utilisateurs récents (pour le Dashboard.vue)
        $recentUsers = User::latest()
            ->take(5)
            ->get()
            ->map(function ($u) {
                return [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'role' => $u->role ?? 'employee',
                    'created_at' => $u->created_at->format('d/m/Y'),
                ];
            });

        // Permissions (pour le Dashboard.vue)
        $permissions = [
            'Gérer les utilisateurs',
            'Gérer les réalisations',
            'Gérer les actualités',
            'Voir les statistiques',
            'Gérer les paramètres',
        ];

        // Statistiques mensuelles pour les graphiques
        $monthlyStats = $this->getMonthlyStats();

        return Inertia::render('Admin/Dashboard/Index', [
            'stats' => $stats,
            'recentRealisations' => $recentRealisations,
            'recentActualites' => $recentActualites,
            'recentUsers' => $recentUsers,
            'permissions' => $permissions,
            'monthlyStats' => $monthlyStats,
        ]);
    }

    /**
     * Récupère les statistiques (API)
     */
    public function getStats()
    {
        return response()->json([
            'total_realisations' => Realisation::count(),
            'total_actualites' => Actualite::count(),
            'total_users' => User::count(),
            'total_leads' => 0, // Lead::count(),
            'realisations_publiees' => Realisation::where('published', true)->count(),
            'actualites_publiees' => Actualite::where('statut', 'publié')->count(),
            'leads_nouveaux' => 0, // Lead::where('status', 'nouveau')->count(),
        ]);
    }

    /**
     * Récupère les activités récentes (API)
     */
    public function getRecentActivities()
    {
        $activities = collect();

        // Dernières réalisations
        $realisations = Realisation::with('user')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'realisation',
                    'action' => 'créée',
                    'title' => $item->titre,
                    'user' => $item->user->name ?? 'Système',
                    'date' => $item->created_at,
                    'formatted_date' => $item->created_at->diffForHumans(),
                ];
            });

        // Dernières actualités
        $actualites = Actualite::with('user')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'actualite',
                    'action' => 'publiée',
                    'title' => $item->titre,
                    'user' => $item->user->name ?? 'Système',
                    'date' => $item->created_at,
                    'formatted_date' => $item->created_at->diffForHumans(),
                ];
            });

        // Derniers leads (désactivé temporairement)
        /*
        $leads = Lead::latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'lead',
                    'action' => 'reçu',
                    'title' => "Contact de {$item->nom}",
                    'user' => 'Site Web',
                    'date' => $item->created_at,
                    'formatted_date' => $item->created_at->diffForHumans(),
                ];
            });
        */

        // Fusionner et trier par date
        $activities = $activities
            ->merge($realisations)
            ->merge($actualites)
            // ->merge($leads) // Désactivé
            ->sortByDesc('date')
            ->take(10)
            ->values();

        return response()->json($activities);
    }

    /**
     * Statistiques mensuelles pour les graphiques
     */
    private function getMonthlyStats()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = [
                'month' => $date->format('M Y'),
                'realisations' => Realisation::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'actualites' => Actualite::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'leads' => 0, // Lead::whereYear... désactivé
            ];
        }

        return $months;
    }
}
