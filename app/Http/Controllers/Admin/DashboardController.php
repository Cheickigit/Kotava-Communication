<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Realisation;
use App\Models\Actualite;
use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord principal
     */
    public function index()
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        // Statistiques principales
        $stats = [
            'total_realisations' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))->count(),
            'total_actualites' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))->count(),
            'total_users' => User::when($teamId, fn($q) => $q->whereHas('teams', fn($q2) => $q2->where('teams.id', $teamId)))->count(),
            'total_leads' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->count(),
            'realisations_publiees' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('published', true)->count(),
            'actualites_publiees' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('statut', 'publié')->count(),
            'realisations_en_cours' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'en_cours')->count(),
            'leads_nouveaux' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'nouveau')->count(),
        ];

        // Réalisations récentes
        $recentRealisations = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->with('team')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($realisation) {
                return [
                    'id' => $realisation->id,
                    'title' => $realisation->title,
                    'client' => $realisation->client,
                    'status' => $realisation->status,
                    'category' => $realisation->category,
                    'created_at' => $realisation->created_at->format('d/m/Y'),
                    'team' => $realisation->team?->name,
                ];
            });

        // Actualités récentes
        $recentActualites = Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->latest('date_publication')
            ->take(5)
            ->get()
            ->map(function ($actualite) {
                return [
                    'id' => $actualite->id,
                    'title' => $actualite->title,
                    'statut' => $actualite->statut,
                    'date_publication' => $actualite->date_publication?->format('d/m/Y'),
                    'category' => $actualite->category,
                ];
            });

        // Utilisateurs récents
        $recentUsers = User::when($teamId, fn($q) => $q->whereHas('teams', fn($q2) => $q2->where('teams.id', $teamId)))
            ->with(['teams', 'roles'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles->first()?->name ?? 'Aucun',
                    'created_at' => $user->created_at->format('d/m/Y'),
                    'teams' => $user->teams->pluck('name')->join(', '),
                ];
            });

        // Leads récents
        $recentLeads = Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'status' => $lead->status,
                    'service' => $lead->service,
                    'created_at' => $lead->created_at->format('d/m/Y H:i'),
                ];
            });

        // Performance mensuelle
        $monthlyPerformance = $this->getMonthlyPerformance($teamId);

        // Statistiques par catégorie
        $categoryStats = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->selectRaw('category, COUNT(*) as count')
            ->where('published', true)
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');

        return Inertia::render('Admin/Dashboard/Index', [
            'stats' => $stats,
            'recentRealisations' => $recentRealisations,
            'recentActualites' => $recentActualites,
            'recentUsers' => $recentUsers,
            'recentLeads' => $recentLeads,
            'monthlyPerformance' => $monthlyPerformance,
            'categoryStats' => $categoryStats,
            'userRole' => $user->roles->first()?->name ?? 'Utilisateur',
        ]);
    }

    /**
     * API pour les statistiques du dashboard
     */
    public function getStats(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $period = $request->get('period', 'monthly'); // daily, weekly, monthly, yearly

        $stats = $this->getPerformanceStats($teamId, $period);

        return response()->json([
            'success' => true,
            'data' => $stats,
            'period' => $period,
        ]);
    }

    /**
     * Récupère les activités récentes
     */
    public function getRecentActivities(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        // Combiner les activités de différents modèles
        $activities = [];

        // Réalisations récentes
        $realisations = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'realisation',
                    'title' => $item->title,
                    'action' => 'créée',
                    'date' => $item->created_at,
                    'user' => 'Système',
                ];
            });

        // Actualités récentes
        $actualites = Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'actualite',
                    'title' => $item->title,
                    'action' => $item->statut === 'publié' ? 'publiée' : 'modifiée',
                    'date' => $item->updated_at,
                    'user' => 'Système',
                ];
            });

        // Combiner et trier
        $activities = collect([...$realisations, ...$actualites])
            ->sortByDesc('date')
            ->take(15)
            ->values();

        return response()->json([
            'success' => true,
            'activities' => $activities,
        ]);
    }

    /**
     * Helper: Performance mensuelle
     */
    private function getMonthlyPerformance($teamId)
    {
        $performance = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            // Projets créés ce mois
            $projects = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();

            // Chiffre d'affaires ce mois
            $revenue = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('budget');

            $performance[] = [
                'month' => $date->format('M'),
                'year' => $date->format('Y'),
                'projects' => $projects,
                'revenue' => $revenue,
            ];
        }

        return $performance;
    }

    /**
     * Helper: Statistiques de performance
     */
    private function getPerformanceStats($teamId, $period = 'monthly')
    {
        $now = now();
        $startDate = match($period) {
            'daily' => $now->copy()->subDay(),
            'weekly' => $now->copy()->subWeek(),
            'monthly' => $now->copy()->subMonth(),
            'yearly' => $now->copy()->subYear(),
            default => $now->copy()->subMonth(),
        };

        return [
            'new_projects' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereBetween('created_at', [$startDate, $now])
                ->count(),
            'new_articles' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereBetween('created_at', [$startDate, $now])
                ->count(),
            'new_leads' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereBetween('created_at', [$startDate, $now])
                ->count(),
            'revenue' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereBetween('created_at', [$startDate, $now])
                ->sum('budget'),
        ];
    }
}
