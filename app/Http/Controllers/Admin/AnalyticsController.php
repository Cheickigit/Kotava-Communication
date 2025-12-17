<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use App\Models\Actualite;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Affiche la page d'analytics
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $period = $request->get('period', 'month'); // day, week, month, year

        // Statistiques principales
        $stats = $this->getMainStats($teamId, $period);

        // Graphiques
        $charts = $this->getChartsData($teamId, $period);

        // Top données
        $topData = $this->getTopData($teamId);

        return Inertia::render('Admin/Analytics/Index', [
            'stats' => $stats,
            'charts' => $charts,
            'topData' => $topData,
            'period' => $period,
            'periodOptions' => [
                'day' => 'Aujourd\'hui',
                'week' => 'Cette semaine',
                'month' => 'Ce mois',
                'year' => 'Cette année',
            ],
        ]);
    }

    /**
     * API pour les données d'analytics
     */
    public function getData(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $period = $request->get('period', 'month');
        $chartType = $request->get('chart', 'projects');

        $data = match($chartType) {
            'projects' => $this->getProjectsChart($teamId, $period),
            'leads' => $this->getLeadsChart($teamId, $period),
            'revenue' => $this->getRevenueChart($teamId, $period),
            'categories' => $this->getCategoriesChart($teamId),
            default => $this->getProjectsChart($teamId, $period),
        };

        return response()->json([
            'success' => true,
            'data' => $data,
            'period' => $period,
            'chart' => $chartType,
        ]);
    }

    /**
     * Statistiques principales
     */
    private function getMainStats($teamId, $period)
    {
        $startDate = $this->getStartDate($period);

        return [
            'new_projects' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->where('created_at', '>=', $startDate)
                ->count(),
            'new_leads' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->where('created_at', '>=', $startDate)
                ->count(),
            'revenue' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->where('created_at', '>=', $startDate)
                ->sum('budget'),
            'conversion_rate' => $this->getConversionRate($teamId, $period),
        ];
    }

    /**
     * Données pour les graphiques
     */
    private function getChartsData($teamId, $period)
    {
        return [
            'projects' => $this->getProjectsChart($teamId, $period),
            'leads' => $this->getLeadsChart($teamId, $period),
            'revenue' => $this->getRevenueChart($teamId, $period),
            'categories' => $this->getCategoriesChart($teamId),
        ];
    }

    /**
     * Top données
     */
    private function getTopData($teamId)
    {
        return [
            'top_clients' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->selectRaw('client, COUNT(*) as project_count, SUM(budget) as total_spent')
                ->groupBy('client')
                ->orderBy('total_spent', 'desc')
                ->limit(5)
                ->get(),
            'top_services' => Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(),
            'top_articles' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->where('statut', 'publié')
                ->orderBy('views', 'desc')
                ->limit(5)
                ->get(['title', 'views', 'created_at']),
        ];
    }

    /**
     * Graphique des projets
     */
    private function getProjectsChart($teamId, $period)
    {
        $labels = [];
        $data = [];

        $interval = match($period) {
            'day' => collect(range(0, 23))->map(fn($h) => now()->subHours(23 - $h)->format('H:00')),
            'week' => collect(range(0, 6))->map(fn($d) => now()->subDays(6 - $d)->format('D')),
            'year' => collect(range(0, 11))->map(fn($m) => now()->subMonths(11 - $m)->format('M')),
            default => collect(range(0, 30))->map(fn($d) => now()->subDays(30 - $d)->format('j M')),
        };

        foreach ($interval as $label) {
            $labels[] = $label;
            $data[] = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereDate('created_at', '>=', now()->subDays(30))
                ->count();
        }

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Projets',
                'data' => $data,
                'borderColor' => '#0e437d',
                'backgroundColor' => 'rgba(14, 67, 125, 0.1)',
            ]]
        ];
    }

    /**
     * Graphique des leads
     */
    private function getLeadsChart($teamId, $period)
    {
        $data = [
            'labels' => ['Nouveaux', 'En contact', 'Devis envoyés', 'Négociation', 'Convertis', 'Perdus'],
            'datasets' => [[
                'label' => 'Leads',
                'data' => [
                    Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'nouveau')->count(),
                    Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'en_contact')->count(),
                    Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'devis_envoye')->count(),
                    Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'negociation')->count(),
                    Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'convertis')->count(),
                    Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'perdus')->count(),
                ],
                'backgroundColor' => [
                    '#22ae84', '#1c978a', '#178e8b', '#0e437d', '#1565c0', '#ff6b6b'
                ],
            ]]
        ];

        return $data;
    }

    /**
     * Graphique des revenus
     */
    private function getRevenueChart($teamId, $period)
    {
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');

            $revenue = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('budget');

            $data[] = $revenue;
        }

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Revenus (FCFA)',
                'data' => $data,
                'borderColor' => '#22ae84',
                'backgroundColor' => 'rgba(34, 174, 132, 0.1)',
            ]]
        ];
    }

    /**
     * Graphique des catégories
     */
    private function getCategoriesChart($teamId)
    {
        $categories = Realisation::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        return [
            'labels' => $categories->pluck('category'),
            'datasets' => [[
                'data' => $categories->pluck('count'),
                'backgroundColor' => ['#0e437d', '#22ae84', '#1c978a', '#178e8b', '#1565c0', '#ff6b6b'],
            ]]
        ];
    }

    /**
     * Taux de conversion
     */
    private function getConversionRate($teamId, $period)
    {
        $startDate = $this->getStartDate($period);

        $totalLeads = Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->where('created_at', '>=', $startDate)
            ->count();

        $convertedLeads = Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->where('status', 'convertis')
            ->where('created_at', '>=', $startDate)
            ->count();

        return $totalLeads > 0 ? round(($convertedLeads / $totalLeads) * 100, 1) : 0;
    }

    /**
     * Date de début selon la période
     */
    private function getStartDate($period)
    {
        return match($period) {
            'day' => now()->startOfDay(),
            'week' => now()->startOfWeek(),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => now()->startOfMonth(),
        };
    }
}
