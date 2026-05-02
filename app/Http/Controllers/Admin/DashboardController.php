<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Realisation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord principal
     */
    public function index()
    {
        $user = Auth::user();

        // Comptage des rôles (Spatie si dispo, sinon colonne users.role si elle existe)
        $roleCounts = $this->getRoleCounts();
        $userRole   = $this->getUserRole($user);

        // Statistiques principales
        $stats = [
            'total_realisations'      => Realisation::count(),
            'total_actualites'        => Actualite::count(),
            'total_users'             => User::count(),
            'total_leads'             => 0,

            'realisations_publiees'   => Realisation::where('published', true)->count(),
            'actualites_publiees'     => Actualite::where('statut', 'publié')->count(),

            'realisations_en_cours'   => 0,
            'leads_nouveaux'          => 0,

            // Données pour le Dashboard.vue existant
            'totalUsers'              => User::count(),
            'adminCount'              => $roleCounts['admin'],
            'managerCount'            => $roleCounts['manager'],
            'employeeCount'           => $roleCounts['employee'],
            'userRole'                => $userRole,
        ];

        // Réalisations récentes
        $recentRealisations = Realisation::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($realisation) {
                return [
                    'id'         => $realisation->id,
                    'titre'      => $realisation->titre ?? $realisation->title ?? 'Sans titre',
                    'client'     => $realisation->client ?? 'N/A',
                    'published'  => (bool) ($realisation->published ?? false),
                    'created_at' => optional($realisation->created_at)->format('d/m/Y'),
                    'user'       => $realisation->user ? [
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
                    'id'         => $actualite->id,
                    'titre'      => $actualite->titre ?? $actualite->title ?? 'Sans titre',
                    'statut'     => $actualite->statut ?? 'brouillon',
                    'created_at' => optional($actualite->created_at)->format('d/m/Y'),
                    'user'       => $actualite->user ? [
                        'name' => $actualite->user->name,
                    ] : null,
                ];
            });

        // Utilisateurs récents
        $recentUsers = User::latest()
            ->take(5)
            ->get()
            ->map(function ($u) {
                return [
                    'id'         => $u->id,
                    'name'       => $u->name,
                    'email'      => $u->email,
                    'role'       => $this->getUserRole($u),
                    'created_at' => optional($u->created_at)->format('d/m/Y'),
                ];
            });

        // Permissions (placeholder)
        $permissions = [
            'Gérer les utilisateurs',
            'Gérer les réalisations',
            'Gérer les actualités',
            'Voir les statistiques',
            'Gérer les paramètres',
        ];

        // Statistiques mensuelles
        $monthlyStats = $this->getMonthlyStats();

        return Inertia::render('Admin/Dashboard/Index', [
            'stats'             => $stats,
            'recentRealisations'=> $recentRealisations,
            'recentActualites'  => $recentActualites,
            'recentUsers'       => $recentUsers,
            'permissions'       => $permissions,
            'monthlyStats'      => $monthlyStats,
        ]);
    }

    /**
     * Récupère les statistiques (API)
     */
    public function getStats()
    {
        $roleCounts = $this->getRoleCounts();

        return response()->json([
            'total_realisations'    => Realisation::count(),
            'total_actualites'      => Actualite::count(),
            'total_users'           => User::count(),
            'total_leads'           => 0,
            'realisations_publiees' => Realisation::where('published', true)->count(),
            'actualites_publiees'   => Actualite::where('statut', 'publié')->count(),
            'leads_nouveaux'        => 0,

            // bonus (si ton front en a besoin)
            'adminCount'            => $roleCounts['admin'],
            'managerCount'          => $roleCounts['manager'],
            'employeeCount'         => $roleCounts['employee'],
        ]);
    }

    /**
     * Récupère les activités récentes (API)
     */
    public function getRecentActivities()
    {
        $realisations = Realisation::with('user')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'type'           => 'realisation',
                    'action'         => 'créée',
                    'title'          => $item->titre ?? $item->title ?? 'Sans titre',
                    'user'           => $item->user->name ?? 'Système',
                    'date'           => $item->created_at,
                    'formatted_date' => optional($item->created_at)->diffForHumans(),
                ];
            });

        $actualites = Actualite::with('user')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'type'           => 'actualite',
                    'action'         => 'publiée',
                    'title'          => $item->titre ?? $item->title ?? 'Sans titre',
                    'user'           => $item->user->name ?? 'Système',
                    'date'           => $item->created_at,
                    'formatted_date' => optional($item->created_at)->diffForHumans(),
                ];
            });

        return response()->json(
            collect()
                ->merge($realisations)
                ->merge($actualites)
                ->sortByDesc('date')
                ->take(10)
                ->values()
        );
    }

    /**
     * Statistiques mensuelles pour les graphiques
     */
    private function getMonthlyStats(): array
    {
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $months[] = [
                'month'        => $date->format('M Y'),
                'realisations' => Realisation::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'actualites'   => Actualite::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'leads'        => 0,
            ];
        }

        return $months;
    }

    /**
     * Détermine si le projet utilise Spatie roles et retourne les compteurs.
     */
    private function getRoleCounts(): array
    {
        $counts = ['admin' => 0, 'manager' => 0, 'employee' => 0];

        // 1) Spatie (méthode scopeRole)
        if (method_exists(User::class, 'role')) {
            $counts['admin'] = User::role('admin')->count();
            $counts['manager'] = User::role('manager')->count();

            // "employee" n'est pas toujours un rôle Spatie : adapte si besoin
            $counts['employee'] = User::role('employee')->count();

            return $counts;
        }

        // 2) Fallback colonne users.role si elle existe
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')) {
            $counts['admin'] = User::where('role', 'admin')->count();
            $counts['manager'] = User::where('role', 'manager')->count();
            $counts['employee'] = User::where('role', 'employee')->count();

            return $counts;
        }

        // 3) Aucun système de rôle détecté -> tout à 0
        return $counts;
    }

    /**
     * Retourne le rôle “principal” à afficher côté UI (Spatie > colonne role > défaut)
     */
    private function getUserRole(?User $user): string
    {
        if (!$user) return 'user';

        // Spatie : prend le 1er rôle si présent
        if (method_exists($user, 'getRoleNames')) {
            $first = $user->getRoleNames()->first();
            return $first ? (string) $first : 'user';
        }

        // Colonne role si elle existe
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role')) {
            return (string) ($user->role ?? 'user');
        }

        return 'user';
    }
}
