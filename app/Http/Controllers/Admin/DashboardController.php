<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Realisation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $roleCounts = $this->getRoleCounts();
        $userRole = $this->getUserRole($user);

        $stats = [
            'total_realisations' => $this->tableExists('realisations') ? Realisation::count() : 0,
            'total_actualites' => $this->tableExists('actualites') ? Actualite::count() : 0,
            'total_users' => $this->tableExists('users') ? User::count() : 0,
            'total_leads' => $this->leadsCount(),

            'realisations_publiees' => $this->publishedRealisationsCount(),
            'actualites_publiees' => $this->publishedActualitesCount(),

            'realisations_en_cours' => $this->realisationsEnCoursCount(),
            'leads_nouveaux' => $this->newLeadsCount(),

            // Compatibilité avec certains dashboards existants
            'totalUsers' => $this->tableExists('users') ? User::count() : 0,
            'adminCount' => $roleCounts['admin'],
            'managerCount' => $roleCounts['manager'],
            'employeeCount' => $roleCounts['employee'],
            'userRole' => $userRole,
        ];

        return Inertia::render('Admin/Dashboard/Index', [
            'stats' => $stats,
            'recentRealisations' => $this->recentRealisations(),
            'recentActualites' => $this->recentActualites(),
            'recentUsers' => $this->recentUsers(),
            'permissions' => $this->permissions(),
            'monthlyStats' => $this->getMonthlyStats(),
            'recentActivities' => $this->recentActivities(),
        ]);
    }

    public function getStats()
    {
        $roleCounts = $this->getRoleCounts();

        return response()->json([
            'total_realisations' => $this->tableExists('realisations') ? Realisation::count() : 0,
            'total_actualites' => $this->tableExists('actualites') ? Actualite::count() : 0,
            'total_users' => $this->tableExists('users') ? User::count() : 0,
            'total_leads' => $this->leadsCount(),

            'realisations_publiees' => $this->publishedRealisationsCount(),
            'actualites_publiees' => $this->publishedActualitesCount(),

            'realisations_en_cours' => $this->realisationsEnCoursCount(),
            'leads_nouveaux' => $this->newLeadsCount(),

            'adminCount' => $roleCounts['admin'],
            'managerCount' => $roleCounts['manager'],
            'employeeCount' => $roleCounts['employee'],
        ]);
    }

    public function getRecentActivities()
    {
        return response()->json($this->recentActivities());
    }

    private function tableExists(string $table): bool
    {
        return Schema::hasTable($table);
    }

    private function columnExists(string $table, string $column): bool
    {
        return $this->tableExists($table) && Schema::hasColumn($table, $column);
    }

    private function firstExistingTable(array $tables): ?string
    {
        foreach ($tables as $table) {
            if ($this->tableExists($table)) {
                return $table;
            }
        }

        return null;
    }

    private function statusColumn(string $table): ?string
    {
        if ($this->columnExists($table, 'statut')) {
            return 'statut';
        }

        if ($this->columnExists($table, 'status')) {
            return 'status';
        }

        return null;
    }

    private function titleColumn(string $table): ?string
    {
        if ($this->columnExists($table, 'title')) {
            return 'title';
        }

        if ($this->columnExists($table, 'titre')) {
            return 'titre';
        }

        return null;
    }

    private function publishedRealisationsCount(): int
    {
        if (! $this->tableExists('realisations')) {
            return 0;
        }

        $query = Realisation::query();

        if ($this->columnExists('realisations', 'published')) {
            $query->where('published', true);
        }

        $statusColumn = $this->statusColumn('realisations');

        if ($statusColumn) {
            $query->where($statusColumn, 'publié');
        }

        return $query->count();
    }

    private function realisationsEnCoursCount(): int
    {
        if (! $this->tableExists('realisations')) {
            return 0;
        }

        $statusColumn = $this->statusColumn('realisations');

        if (! $statusColumn) {
            return 0;
        }

        return Realisation::where($statusColumn, 'en_cours')->count();
    }

    private function publishedActualitesCount(): int
    {
        if (! $this->tableExists('actualites')) {
            return 0;
        }

        $query = Actualite::query();

        if ($this->columnExists('actualites', 'published')) {
            $query->where('published', true);
            return $query->count();
        }

        $statusColumn = $this->statusColumn('actualites');

        if ($statusColumn) {
            $query->where($statusColumn, 'publié');
            return $query->count();
        }

        return 0;
    }

    private function leadsTable(): ?string
    {
        return $this->firstExistingTable([
            'leads',
            'contacts',
            'contact_messages',
            'messages',
        ]);
    }

    private function leadsCount(): int
    {
        $table = $this->leadsTable();

        if (! $table) {
            return 0;
        }

        return DB::table($table)->count();
    }

    private function newLeadsCount(): int
    {
        $table = $this->leadsTable();

        if (! $table) {
            return 0;
        }

        if ($this->columnExists($table, 'is_read')) {
            return DB::table($table)->where('is_read', false)->count();
        }

        if ($this->columnExists($table, 'statut')) {
            return DB::table($table)->where('statut', 'nouveau')->count();
        }

        if ($this->columnExists($table, 'status')) {
            return DB::table($table)->whereIn('status', ['new', 'nouveau'])->count();
        }

        return 0;
    }

    private function recentRealisations()
    {
        if (! $this->tableExists('realisations')) {
            return collect();
        }

        $titleColumn = $this->titleColumn('realisations');

        return Realisation::query()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($realisation) use ($titleColumn) {
                return [
                    'id' => $realisation->id,
                    'titre' => $titleColumn ? $realisation->{$titleColumn} : 'Sans titre',
                    'title' => $titleColumn ? $realisation->{$titleColumn} : 'Sans titre',
                    'client' => $realisation->client ?? 'N/A',
                    'published' => (bool) ($realisation->published ?? false),
                    'statut' => $realisation->statut ?? $realisation->status ?? null,
                    'created_at' => optional($realisation->created_at)->format('d/m/Y'),
                    'href' => '/dashboard/realisations',
                    'user' => null,
                ];
            });
    }

    private function recentActualites()
    {
        if (! $this->tableExists('actualites')) {
            return collect();
        }

        $titleColumn = $this->titleColumn('actualites');

        return Actualite::query()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($actualite) use ($titleColumn) {
                return [
                    'id' => $actualite->id,
                    'titre' => $titleColumn ? $actualite->{$titleColumn} : 'Sans titre',
                    'title' => $titleColumn ? $actualite->{$titleColumn} : 'Sans titre',
                    'statut' => $actualite->statut ?? $actualite->status ?? 'brouillon',
                    'created_at' => optional($actualite->created_at)->format('d/m/Y'),
                    'href' => '/dashboard/actualites',
                    'user' => null,
                ];
            });
    }

    private function recentUsers()
    {
        if (! $this->tableExists('users')) {
            return collect();
        }

        return User::query()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $this->getUserRole($user),
                    'created_at' => optional($user->created_at)->format('d/m/Y'),
                ];
            });
    }

    private function recentActivities()
    {
        $activities = collect();

        $this->recentRealisations()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'realisation',
                'label' => 'Réalisation',
                'action' => 'créée',
                'title' => $item['title'] ?? $item['titre'] ?? 'Sans titre',
                'description' => 'Projet ajouté ou mis à jour dans le portfolio.',
                'user' => 'Système',
                'href' => '/dashboard/realisations',
                'date' => $item['created_at'],
                'formatted_date' => $item['created_at'],
            ]);
        });

        $this->recentActualites()->each(function ($item) use ($activities) {
            $activities->push([
                'type' => 'actualite',
                'label' => 'Actualité',
                'action' => 'publiée',
                'title' => $item['title'] ?? $item['titre'] ?? 'Sans titre',
                'description' => 'Article ajouté ou mis à jour.',
                'user' => 'Système',
                'href' => '/dashboard/actualites',
                'date' => $item['created_at'],
                'formatted_date' => $item['created_at'],
            ]);
        });

        $leadTable = $this->leadsTable();

        if ($leadTable && $this->columnExists($leadTable, 'created_at')) {
            DB::table($leadTable)
                ->latest()
                ->take(5)
                ->get()
                ->each(function ($item) use ($activities) {
                    $activities->push([
                        'type' => 'lead',
                        'label' => 'Contact',
                        'action' => 'reçu',
                        'title' => 'Nouveau message reçu',
                        'description' => 'Une demande de contact a été envoyée depuis le site.',
                        'user' => 'Visiteur',
                        'href' => '/dashboard/leads',
                        'date' => optional($item->created_at)->format('d/m/Y'),
                        'formatted_date' => optional($item->created_at)->format('d/m/Y'),
                    ]);
                });
        }

        return $activities
            ->take(10)
            ->values();
    }

    private function permissions(): array
    {
        return [
            'Gérer les réalisations',
            'Gérer les actualités',
            'Gérer les contacts',
            'Voir les statistiques',
        ];
    }

    private function getMonthlyStats(): array
    {
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $months[] = [
                'month' => $date->format('M Y'),
                'realisations' => $this->tableExists('realisations')
                    ? Realisation::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count()
                    : 0,
                'actualites' => $this->tableExists('actualites')
                    ? Actualite::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count()
                    : 0,
                'leads' => $this->monthlyLeadsCount($date),
            ];
        }

        return $months;
    }

    private function monthlyLeadsCount(Carbon $date): int
    {
        $table = $this->leadsTable();

        if (! $table || ! $this->columnExists($table, 'created_at')) {
            return 0;
        }

        return DB::table($table)
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->count();
    }

    private function getRoleCounts(): array
    {
        $counts = [
            'admin' => 0,
            'manager' => 0,
            'employee' => 0,
        ];

        if (! $this->tableExists('users')) {
            return $counts;
        }

        if (method_exists(User::class, 'role')) {
            try {
                $counts['admin'] = User::role('admin')->count();
                $counts['manager'] = User::role('manager')->count();
                $counts['employee'] = User::role('employee')->count();

                return $counts;
            } catch (\Throwable $e) {
                // Fallback vers users.role si Spatie n'est pas correctement configuré.
            }
        }

        if ($this->columnExists('users', 'role')) {
            $counts['admin'] = User::where('role', 'admin')->count();
            $counts['manager'] = User::where('role', 'manager')->count();
            $counts['employee'] = User::where('role', 'employee')->count();
        }

        return $counts;
    }

    private function getUserRole(?User $user): string
    {
        if (! $user) {
            return 'user';
        }

        if (method_exists($user, 'getRoleNames')) {
            try {
                $first = $user->getRoleNames()->first();

                if ($first) {
                    return (string) $first;
                }
            } catch (\Throwable $e) {
                // Fallback vers users.role.
            }
        }

        if ($this->columnExists('users', 'role')) {
            return (string) ($user->role ?? 'user');
        }

        return 'user';
    }
}