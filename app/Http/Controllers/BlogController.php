<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BlogController extends Controller
{
    private array $tableCache = [];
    private array $columnCache = [];

    private function categoryLabels(): array
    {
        return [
            'actualite' => 'Actualité',
            'blog' => 'Article Blog',
            'communique' => 'Communiqué',
            'temoignage' => 'Témoignage',
            'cas_etude' => 'Cas d’étude',
        ];
    }

    private function tableExists(string $table): bool
    {
        if (! array_key_exists($table, $this->tableCache)) {
            $this->tableCache[$table] = Schema::hasTable($table);
        }

        return $this->tableCache[$table];
    }

    private function columnExists(string $table, string $column): bool
    {
        $key = "{$table}.{$column}";

        if (! array_key_exists($key, $this->columnCache)) {
            $this->columnCache[$key] = $this->tableExists($table) && Schema::hasColumn($table, $column);
        }

        return $this->columnCache[$key];
    }

    private function actualiteColumn(string $column): bool
    {
        return $this->columnExists('actualites', $column);
    }

    private function statusColumn(): ?string
    {
        if ($this->actualiteColumn('statut')) {
            return 'statut';
        }

        if ($this->actualiteColumn('status')) {
            return 'status';
        }

        return null;
    }

    private function titleColumn(): string
    {
        if ($this->actualiteColumn('title')) {
            return 'title';
        }

        if ($this->actualiteColumn('titre')) {
            return 'titre';
        }

        return 'title';
    }

    private function contentColumn(): ?string
    {
        if ($this->actualiteColumn('content')) {
            return 'content';
        }

        if ($this->actualiteColumn('description')) {
            return 'description';
        }

        return null;
    }

    private function publicUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['/storage/', '/images/', '/assets/'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    private function absoluteUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return url($path);
    }

    private function basePublishedQuery()
    {
        $query = Actualite::query();

        $statusColumn = $this->statusColumn();

        if ($statusColumn && $this->actualiteColumn('published')) {
            $query->where(function ($q) use ($statusColumn) {
                $q->where($statusColumn, 'publié')
                    ->orWhere('published', true);
            });
        } elseif ($statusColumn) {
            $query->where($statusColumn, 'publié');
        } elseif ($this->actualiteColumn('published')) {
            $query->where('published', true);
        }

        if ($this->actualiteColumn('date_publication')) {
            $query->where(function ($q) {
                $q->whereNull('date_publication')
                    ->orWhere('date_publication', '<=', now());
            });
        }

        return $query;
    }

    private function applySearch($query, ?string $search)
    {
        $search = trim((string) $search);

        if ($search === '') {
            return $query;
        }

        $operator = config('database.default') === 'pgsql' ? 'ilike' : 'like';

        return $query->where(function ($q) use ($search, $operator) {
            if ($this->actualiteColumn('title')) {
                $q->orWhere('title', $operator, "%{$search}%");
            }

            if ($this->actualiteColumn('titre')) {
                $q->orWhere('titre', $operator, "%{$search}%");
            }

            if ($this->actualiteColumn('extrait')) {
                $q->orWhere('extrait', $operator, "%{$search}%");
            }

            if ($this->actualiteColumn('description')) {
                $q->orWhere('description', $operator, "%{$search}%");
            }

            if ($this->actualiteColumn('content')) {
                $q->orWhere('content', $operator, "%{$search}%");
            }
        });
    }

    private function applyCategory($query, ?string $category)
    {
        if (! $this->actualiteColumn('category')) {
            return $query;
        }

        if (! $category || $category === 'tous' || $category === 'all') {
            return $query;
        }

        return $query->where('category', $category);
    }

    private function orderActualites($query)
    {
        if ($this->actualiteColumn('date_publication')) {
            return $query
                ->orderByDesc('date_publication')
                ->orderByDesc('created_at');
        }

        return $query->latest();
    }

    private function mapActualite(Actualite $actualite): array
    {
        $titleColumn = $this->titleColumn();
        $contentColumn = $this->contentColumn();

        $title = $actualite->{$titleColumn} ?? $actualite->title ?? $actualite->titre ?? 'Sans titre';
        $content = $contentColumn ? ($actualite->{$contentColumn} ?? '') : '';
        $description = $actualite->description ?? $content;
        $excerpt = $actualite->extrait ?: Str::limit(strip_tags($content ?: $description), 180);

        $category = $actualite->category ?? 'actualite';
        $status = $actualite->statut ?? $actualite->status ?? null;

        $imageUrl = $this->publicUrl($actualite->image ?? null);

        return [
            'id' => $actualite->id,
            'title' => $title,
            'titre' => $title,
            'slug' => $actualite->slug,
            'url' => $actualite->slug ? "/blog/{$actualite->slug}" : '/blog',

            'extrait' => $excerpt,
            'summary' => $excerpt,
            'description' => $description,
            'content' => $content ?: $description,

            'category' => $category,
            'category_label' => $this->categoryLabels()[$category] ?? Str::headline($category),

            'statut' => $status,
            'status' => $status,
            'published' => (bool) ($actualite->published ?? ($status === 'publié')),
            'featured' => (bool) ($actualite->featured ?? false),

            'image' => $imageUrl,
            'image_url' => $imageUrl,

            'date_publication' => optional($actualite->date_publication)->format('Y-m-d'),
            'date_publication_display' => optional($actualite->date_publication)->format('d/m/Y'),
            'created_at' => optional($actualite->created_at)->format('d/m/Y'),
            'created_at_human' => optional($actualite->created_at)->diffForHumans(),

            'meta_title' => $actualite->meta_title ?? null,
            'meta_description' => $actualite->meta_description ?? null,
        ];
    }

    private function filterCategories(): array
    {
        $labels = $this->categoryLabels();

        if (! $this->tableExists('actualites')) {
            return [
                [
                    'slug' => 'tous',
                    'name' => 'Toutes',
                    'label' => 'Toutes',
                    'count' => 0,
                ],
            ];
        }

        $total = $this->basePublishedQuery()->count();

        $categories = [
            [
                'slug' => 'tous',
                'name' => 'Toutes',
                'label' => 'Toutes',
                'count' => $total,
            ],
        ];

        if (! $this->actualiteColumn('category')) {
            return $categories;
        }

        $items = $this->basePublishedQuery()
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        foreach ($items as $category) {
            $categories[] = [
                'slug' => $category,
                'name' => $labels[$category] ?? Str::headline($category),
                'label' => $labels[$category] ?? Str::headline($category),
                'count' => $this->basePublishedQuery()
                    ->where('category', $category)
                    ->count(),
            ];
        }

        return $categories;
    }

    private function emptyPaginator(Request $request, int $perPage = 9): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            [],
            0,
            $perPage,
            LengthAwarePaginator::resolveCurrentPage(),
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
    }

    public function index(Request $request)
    {
        if (! $this->tableExists('actualites')) {
            return Inertia::render('Blog/Index', [
                'actualites' => $this->emptyPaginator($request),
                'featuredActualites' => [],
                'recentActualites' => [],
                'categories' => $this->filterCategories(),
                'filters' => $request->only(['search', 'category']),
                'currentFilter' => $request->get('category', 'tous'),
                'meta' => [
                    'title' => 'Actualités - KOTAVA Communication',
                    'description' => 'Découvrez les actualités, articles et communiqués de KOTAVA Communication.',
                ],
            ]);
        }

        $query = $this->basePublishedQuery();

        $this->applySearch($query, $request->get('search'));
        $this->applyCategory($query, $request->get('category'));

        $actualites = $this->orderActualites($query)
            ->paginate(9)
            ->withQueryString()
            ->through(fn (Actualite $actualite) => $this->mapActualite($actualite));

        $featuredQuery = $this->basePublishedQuery();

        if ($this->actualiteColumn('featured')) {
            $featuredQuery->where('featured', true);
        }

        $featuredActualites = $this->orderActualites($featuredQuery)
            ->take(3)
            ->get()
            ->map(fn (Actualite $actualite) => $this->mapActualite($actualite))
            ->values();

        $recentActualites = $this->orderActualites($this->basePublishedQuery())
            ->take(5)
            ->get()
            ->map(fn (Actualite $actualite) => $this->mapActualite($actualite))
            ->values();

        return Inertia::render('Blog/Index', [
            'actualites' => $actualites,
            'featuredActualites' => $featuredActualites,
            'recentActualites' => $recentActualites,
            'categories' => $this->filterCategories(),
            'filters' => $request->only(['search', 'category']),
            'currentFilter' => $request->get('category', 'tous'),
            'meta' => [
                'title' => 'Actualités - KOTAVA Communication',
                'description' => 'Découvrez les actualités, articles, communiqués et analyses de KOTAVA Communication.',
            ],
        ]);
    }

    public function show(string $slug)
    {
        $actualite = $this->basePublishedQuery()
            ->where('slug', $slug)
            ->firstOrFail();

        $mappedActualite = $this->mapActualite($actualite);

        $relatedQuery = $this->basePublishedQuery()
            ->where('id', '!=', $actualite->id);

        if ($this->actualiteColumn('category') && $actualite->category) {
            $relatedQuery->where('category', $actualite->category);
        }

        $relatedActualites = $this->orderActualites($relatedQuery)
            ->take(3)
            ->get()
            ->map(fn (Actualite $item) => $this->mapActualite($item))
            ->values();

        $recentActualites = $this->orderActualites(
            $this->basePublishedQuery()->where('id', '!=', $actualite->id)
        )
            ->take(5)
            ->get()
            ->map(fn (Actualite $item) => $this->mapActualite($item))
            ->values();

        $prevActualite = $this->basePublishedQuery()
            ->where('id', '<', $actualite->id)
            ->orderByDesc('id')
            ->first();

        $nextActualite = $this->basePublishedQuery()
            ->where('id', '>', $actualite->id)
            ->orderBy('id')
            ->first();

        return Inertia::render('Blog/Show', [
            'actualite' => $mappedActualite,
            'relatedActualites' => $relatedActualites,
            'recentActualites' => $recentActualites,
            'prevActualite' => $prevActualite ? $this->mapActualite($prevActualite) : null,
            'nextActualite' => $nextActualite ? $this->mapActualite($nextActualite) : null,
            'meta' => [
                'title' => $mappedActualite['meta_title'] ?: "{$mappedActualite['title']} - KOTAVA Communication",
                'description' => $mappedActualite['meta_description'] ?: $mappedActualite['extrait'],
                'image' => $this->absoluteUrl($mappedActualite['image_url']),
                'url' => url("/blog/{$mappedActualite['slug']}"),
            ],
        ]);
    }

    public function apiIndex(Request $request)
    {
        if (! $this->tableExists('actualites')) {
            return response()->json([
                'data' => [],
                'meta' => [
                    'total' => 0,
                ],
            ]);
        }

        $query = $this->basePublishedQuery();

        $this->applySearch($query, $request->get('search'));
        $this->applyCategory($query, $request->get('category'));

        $actualites = $this->orderActualites($query)
            ->paginate((int) $request->get('per_page', 9))
            ->withQueryString()
            ->through(fn (Actualite $actualite) => $this->mapActualite($actualite));

        return response()->json($actualites);
    }

    public function apiShow(string $slug)
    {
        $actualite = $this->basePublishedQuery()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => $this->mapActualite($actualite),
        ]);
    }
}