<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Realisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    private function statusColumn(): ?string
    {
        if (Schema::hasColumn('realisations', 'statut')) {
            return 'statut';
        }

        if (Schema::hasColumn('realisations', 'status')) {
            return 'status';
        }

        return null;
    }

    private function hasCategoriesTable(): bool
    {
        return Schema::hasTable('categories') && Schema::hasColumn('realisations', 'categorie_id');
    }

    private function categoryLabels(): array
    {
        return [
            'branding'   => 'Branding & Identité',
            'web'        => 'Web & Digital',
            'social'     => 'Social Media',
            'video'      => 'Production Vidéo',
            'marketing'  => 'Marketing Stratégique',
            'consulting' => 'Consulting',
        ];
    }

    private function publicUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/storage/', '/images/', '/assets/'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    private function basePublishedQuery()
    {
        $query = Realisation::query();

        if (Schema::hasColumn('realisations', 'published')) {
            $query->where('published', true);
        }

        $statusCol = $this->statusColumn();

        if ($statusCol) {
            $query->where($statusCol, 'publié');
        }

        return $query;
    }

    private function withCategorieIfExists($query)
    {
        if ($this->hasCategoriesTable()) {
            return $query->with('categorie');
        }

        return $query;
    }

    private function categoryName(?Realisation $realisation): string
    {
        if (! $realisation) {
            return 'Projet';
        }

        if ($this->hasCategoriesTable() && $realisation->relationLoaded('categorie') && $realisation->categorie) {
            return $realisation->categorie->name;
        }

        if ($realisation->category) {
            return $this->categoryLabels()[$realisation->category] ?? ucfirst($realisation->category);
        }

        return $realisation->sector ?: 'Projet';
    }

    private function categorySlug(?Realisation $realisation): string
    {
        if (! $realisation) {
            return 'general';
        }

        if ($this->hasCategoriesTable() && $realisation->relationLoaded('categorie') && $realisation->categorie) {
            return $realisation->categorie->slug;
        }

        return $realisation->category ?: 'general';
    }

    private function formatDate($date): ?string
    {
        if (! $date) {
            return null;
        }

        if (is_string($date)) {
            return $date;
        }

        return $date->format('d/m/Y');
    }

    private function normalizeArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    private function galleryItems(Realisation $realisation): array
    {
        $items = [];
        $paths = [];

        foreach ($this->normalizeArray($realisation->gallery) as $item) {
            if (is_string($item)) {
                $paths[] = $item;
            }

            if (is_array($item)) {
                $paths[] = $item['path'] ?? $item['url'] ?? $item['image'] ?? null;
            }
        }

        foreach ($this->normalizeArray($realisation->media) as $item) {
            if (is_string($item)) {
                $paths[] = $item;
            }

            if (is_array($item)) {
                $paths[] = $item['path'] ?? $item['url'] ?? $item['image'] ?? null;
            }
        }

        $paths = array_values(array_unique(array_filter($paths)));

        foreach ($paths as $path) {
            $items[] = [
                'url'  => $this->publicUrl($path),
                'path' => $path,
                'alt'  => $realisation->title,
            ];
        }

        return $items;
    }

    private function mapProject(Realisation $realisation): array
    {
        return [
            'id'                => $realisation->id,
            'title'             => $realisation->title,
            'slug'              => $realisation->slug,
            'description'       => $realisation->description,
            'short_description' => $realisation->short_description
                ?: $realisation->summary
                ?: Str::limit(strip_tags($realisation->description), 150),
            'image'             => $this->publicUrl($realisation->image),
            'cover_image'       => $this->publicUrl($realisation->cover_image),
            'client_logo'       => $this->publicUrl($realisation->client_logo),
            'client'            => $realisation->client,
            'category'          => $this->categoryName($realisation),
            'category_slug'     => $this->categorySlug($realisation),
            'status'            => $realisation->statut ?? $realisation->status,
            'featured'          => (bool) $realisation->featured,
            'sector'            => $realisation->sector,
            'country'           => $realisation->country,
            'type'              => $realisation->type,
            'completion_date'   => $this->formatDate($realisation->completion_date),
            'created_at'        => $this->formatDate($realisation->created_at),
        ];
    }

    private function filterCategories(): array
    {
        $items = [
            [
                'id'    => 'all',
                'name'  => 'Tous les projets',
                'count' => (clone $this->basePublishedQuery())->count(),
            ],
        ];

        if ($this->hasCategoriesTable()) {
            $categories = Categorie::query()
                ->whereHas('realisations', function ($query) {
                    if (Schema::hasColumn('realisations', 'published')) {
                        $query->where('published', true);
                    }

                    $statusCol = $this->statusColumn();

                    if ($statusCol) {
                        $query->where($statusCol, 'publié');
                    }
                })
                ->orderBy('name')
                ->get(['id', 'name', 'slug']);

            foreach ($categories as $category) {
                $items[] = [
                    'id'    => $category->slug,
                    'name'  => $category->name,
                    'count' => (clone $this->basePublishedQuery())
                        ->where(function ($query) use ($category) {
                            $query->where('categorie_id', $category->id);

                            if (Schema::hasColumn('realisations', 'category')) {
                                $query->orWhere('category', $category->slug);
                            }
                        })
                        ->count(),
                ];
            }

            return $items;
        }

        foreach ($this->categoryLabels() as $slug => $name) {
            $count = Schema::hasColumn('realisations', 'category')
                ? (clone $this->basePublishedQuery())->where('category', $slug)->count()
                : 0;

            if ($count > 0) {
                $items[] = [
                    'id'    => $slug,
                    'name'  => $name,
                    'count' => $count,
                ];
            }
        }

        return $items;
    }

    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = $this->basePublishedQuery();

        if ($filter !== 'all') {
            $query->where(function ($q) use ($filter) {
                if (Schema::hasColumn('realisations', 'category')) {
                    $q->where('category', $filter);
                }

                if ($this->hasCategoriesTable()) {
                    $q->orWhereHas('categorie', function ($categoryQuery) use ($filter) {
                        $categoryQuery->where('slug', $filter);
                    });
                }
            });
        }

        $query = $this->withCategorieIfExists($query);

        $realisations = $query
            ->latest()
            ->paginate(9)
            ->withQueryString()
            ->through(fn ($realisation) => $this->mapProject($realisation));

        $filterCategories = $this->filterCategories();

        $totalPublished = (clone $this->basePublishedQuery())->count();

        $stats = [
            'total_projects'     => $totalPublished,
            'total_clients'      => (clone $this->basePublishedQuery())->distinct('client')->count('client'),
            'ongoing_projects'   => $this->statusColumn()
                ? Realisation::where('published', true)->where($this->statusColumn(), 'en_cours')->count()
                : 0,
            'completed_projects' => $this->statusColumn()
                ? Realisation::where('published', true)->where($this->statusColumn(), 'termine')->count()
                : 0,
            'featured_projects'  => (clone $this->basePublishedQuery())->where('featured', true)->count(),
            'success_rate'       => $totalPublished > 0 ? 100 : 0,
        ];

        $featuredQuery = $this->withCategorieIfExists(
            (clone $this->basePublishedQuery())->where('featured', true)
        );

        $featuredProjects = $featuredQuery
            ->latest()
            ->take(3)
            ->get()
            ->map(fn ($realisation) => $this->mapProject($realisation))
            ->values();

        $recentQuery = $this->withCategorieIfExists(
            (clone $this->basePublishedQuery())
        );

        $recentProjects = $recentQuery
            ->latest()
            ->take(6)
            ->get()
            ->map(fn ($realisation) => $this->mapProject($realisation))
            ->values();

        return Inertia::render('Portfolio/Index', [
            'realisations'      => $realisations,
            'featuredProjects'  => $featuredProjects,
            'recentProjects'    => $recentProjects,
            'stats'             => $stats,
            'categories'        => $filterCategories,
            'filters'           => $filterCategories,
            'currentFilter'     => $filter,
            'meta'              => [
                'title'       => 'Portfolio - KOTAVA Communication',
                'description' => 'Découvrez les réalisations de KOTAVA Communication en branding, stratégie, digital, social media, audiovisuel et événementiel.',
                'keywords'    => 'portfolio KOTAVA Communication, réalisations communication, branding Bénin, agence digitale Cotonou, social media, audiovisuel, événementiel',
            ],
        ]);
    }

    public function show($slug)
    {
        $query = $this->withCategorieIfExists(
            $this->basePublishedQuery()
        );

        $realisation = $query
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedQuery = $this->basePublishedQuery()
            ->where('id', '!=', $realisation->id);

        if ($this->hasCategoriesTable() && $realisation->categorie_id) {
            $relatedQuery->where('categorie_id', $realisation->categorie_id);
        } elseif ($realisation->category) {
            $relatedQuery->where('category', $realisation->category);
        }

        $relatedQuery = $this->withCategorieIfExists($relatedQuery);

        $relatedProjects = $relatedQuery
            ->latest()
            ->take(3)
            ->get()
            ->map(fn ($item) => $this->mapProject($item))
            ->values();

        $nextProject = $this->basePublishedQuery()
            ->where('id', '>', $realisation->id)
            ->orderBy('id')
            ->first(['id', 'title', 'slug']);

        $prevProject = $this->basePublishedQuery()
            ->where('id', '<', $realisation->id)
            ->orderByDesc('id')
            ->first(['id', 'title', 'slug']);

        $mapped = $this->mapProject($realisation);

        return Inertia::render('Portfolio/Show', [
            'realisation' => array_merge($mapped, [
                'summary'            => $realisation->summary,
                'context'            => $realisation->context,
                'solution'           => $realisation->solution,
                'results'            => $realisation->results,
                'client_testimony'   => $realisation->client_testimony ?: $realisation->testimonial,
                'testimonial_author' => $realisation->testimonial_author,
            ]),
            'relatedProjects' => $relatedProjects,
            'nextProject'     => $nextProject,
            'prevProject'     => $prevProject,
            'gallery'         => $this->galleryItems($realisation),
            'meta'            => [
                'title'       => $realisation->title . ' - KOTAVA Communication',
                'description' => $realisation->summary ?: Str::limit(strip_tags($realisation->description), 160),
                'image'       => $this->publicUrl($realisation->image),
            ],
        ]);
    }

    public function filter(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $page = (int) $request->input('page', 1);

        $query = $this->basePublishedQuery();

        if ($filter !== 'all') {
            $query->where(function ($q) use ($filter) {
                if (Schema::hasColumn('realisations', 'category')) {
                    $q->where('category', $filter);
                }

                if ($this->hasCategoriesTable()) {
                    $q->orWhereHas('categorie', function ($categoryQuery) use ($filter) {
                        $categoryQuery->where('slug', $filter);
                    });
                }
            });
        }

        $query = $this->withCategorieIfExists($query);

        $realisations = $query
            ->latest()
            ->paginate(9, ['*'], 'page', $page)
            ->through(fn ($realisation) => $this->mapProject($realisation));

        return response()->json([
            'realisations'    => $realisations,
            'current_filter'  => $filter,
        ]);
    }

    public function apiIndex(Request $request)
    {
        $query = $this->withCategorieIfExists(
            $this->basePublishedQuery()
        );

        return response()->json([
            'data' => $query
                ->latest()
                ->take(12)
                ->get()
                ->map(fn ($realisation) => $this->mapProject($realisation))
                ->values(),
        ]);
    }

    public function apiShow($slug)
    {
        $query = $this->withCategorieIfExists(
            $this->basePublishedQuery()
        );

        $realisation = $query
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => array_merge($this->mapProject($realisation), [
                'summary'          => $realisation->summary,
                'context'          => $realisation->context,
                'solution'         => $realisation->solution,
                'results'          => $realisation->results,
                'client_testimony' => $realisation->client_testimony ?: $realisation->testimonial,
                'gallery'          => $this->galleryItems($realisation),
            ]),
        ]);
    }
}