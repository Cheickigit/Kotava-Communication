<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ActualiteController extends Controller
{
    private function categories(): array
    {
        return [
            'actualite'  => 'Actualité',
            'blog'       => 'Article Blog',
            'communique' => 'Communiqué',
            'temoignage' => 'Témoignage Client',
            'cas_etude'  => 'Cas d’étude',
        ];
    }

    private function statuts(): array
    {
        return [
            'tous'      => 'Tous',
            'brouillon' => 'Brouillon',
            'publié'    => 'Publié',
            'archivé'   => 'Archivé',
        ];
    }

    private function columnExists(string $column): bool
    {
        return Schema::hasTable('actualites') && Schema::hasColumn('actualites', $column);
    }

    private function onlyExistingColumns(array $data): array
    {
        return collect($data)
            ->filter(fn ($value, $key) => $this->columnExists($key))
            ->toArray();
    }

    private function statusColumn(): ?string
    {
        if ($this->columnExists('statut')) {
            return 'statut';
        }

        if ($this->columnExists('status')) {
            return 'status';
        }

        return null;
    }

    private function titleColumn(): string
    {
        if ($this->columnExists('title')) {
            return 'title';
        }

        if ($this->columnExists('titre')) {
            return 'titre';
        }

        return 'title';
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

    private function currentTeamId(): ?int
{
    $user = Auth::user();

    if (! $user) {
        return null;
    }

    if (Schema::hasTable('users') && Schema::hasColumn('users', 'current_team_id')) {
        return $user->current_team_id ? (int) $user->current_team_id : null;
    }

    return null;
}

    private function applyTeamScope($query)
    {
        $teamId = $this->currentTeamId();

        if ($teamId && $this->columnExists('team_id')) {
            $query->where('team_id', $teamId);
        }

        return $query;
    }

    private function mapActualite(Actualite $actualite): array
    {
        $titleColumn = $this->titleColumn();

        $title = $actualite->{$titleColumn} ?? $actualite->title ?? $actualite->titre ?? 'Sans titre';
        $content = $actualite->content ?? $actualite->description ?? '';

        return [
            'id' => $actualite->id,
            'title' => $title,
            'titre' => $title,
            'slug' => $actualite->slug,
            'extrait' => $actualite->extrait,
            'description' => $actualite->description ?? $content,
            'content' => $content,
            'category' => $actualite->category ?? 'actualite',
            'category_label' => $this->categories()[$actualite->category ?? 'actualite'] ?? 'Actualité',
            'statut' => $actualite->statut ?? $actualite->status ?? 'brouillon',
            'status' => $actualite->statut ?? $actualite->status ?? 'brouillon',
            'published' => (bool) ($actualite->published ?? (($actualite->statut ?? null) === 'publié')),
            'featured' => (bool) ($actualite->featured ?? false),
            'image' => $actualite->image,
            'image_url' => $this->publicUrl($actualite->image),
            'date_publication' => optional($actualite->date_publication)->format('Y-m-d'),
            'date_publication_display' => optional($actualite->date_publication)->format('d/m/Y'),
            'meta_title' => $actualite->meta_title ?? null,
            'meta_description' => $actualite->meta_description ?? null,
            'created_at' => optional($actualite->created_at)->format('d/m/Y'),
            'updated_at' => optional($actualite->updated_at)->format('d/m/Y'),
            'user' => $actualite->relationLoaded('user') && $actualite->user
                ? ['name' => $actualite->user->name]
                : null,
        ];
    }

    public function index(Request $request)
    {
        $query = Actualite::query();

        if ($this->columnExists('user_id')) {
            $query->with('user');
        }

        $this->applyTeamScope($query);

        $statusCol = $this->statusColumn();

        if ($request->filled('statut') && $request->statut !== 'tous' && $statusCol) {
            $query->where($statusCol, $request->statut);
        }

        if ($request->filled('category') && $request->category !== 'tous' && $this->columnExists('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $operator = config('database.default') === 'pgsql' ? 'ilike' : 'like';

            $query->where(function ($q) use ($search, $operator) {
                if ($this->columnExists('title')) {
                    $q->orWhere('title', $operator, "%{$search}%");
                }

                if ($this->columnExists('titre')) {
                    $q->orWhere('titre', $operator, "%{$search}%");
                }

                if ($this->columnExists('content')) {
                    $q->orWhere('content', $operator, "%{$search}%");
                }

                if ($this->columnExists('description')) {
                    $q->orWhere('description', $operator, "%{$search}%");
                }

                if ($this->columnExists('extrait')) {
                    $q->orWhere('extrait', $operator, "%{$search}%");
                }
            });
        }

        if ($this->columnExists('date_publication')) {
            $query->latest('date_publication');
        } else {
            $query->latest();
        }

        $actualites = $query
            ->paginate(15)
            ->withQueryString()
            ->through(fn ($actualite) => $this->mapActualite($actualite));

        $baseStatsQuery = Actualite::query();
        $this->applyTeamScope($baseStatsQuery);

        $publishedQuery = Actualite::query();
        $this->applyTeamScope($publishedQuery);

        $draftQuery = Actualite::query();
        $this->applyTeamScope($draftQuery);

        $featuredQuery = Actualite::query();
        $this->applyTeamScope($featuredQuery);

        $stats = [
            'total' => $baseStatsQuery->count(),

            'publie' => $statusCol
                ? $publishedQuery->where($statusCol, 'publié')->count()
                : ($this->columnExists('published')
                    ? $publishedQuery->where('published', true)->count()
                    : 0),

            'brouillon' => $statusCol
                ? $draftQuery->where($statusCol, 'brouillon')->count()
                : 0,

            'featured' => $this->columnExists('featured')
                ? $featuredQuery->where('featured', true)->count()
                : 0,
        ];

        return Inertia::render('Admin/Actualites/Index', [
            'actualites' => $actualites,
            'filters' => $request->only(['search', 'statut', 'category']),
            'stats' => $stats,
            'categories' => $this->categories(),
            'statuts' => $this->statuts(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Actualites/Create', [
            'categories' => $this->categories(),
            'statuts' => [
                'brouillon' => 'Brouillon',
                'publié' => 'Publié',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:actualites,slug',
            'extrait' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:actualite,blog,communique,temoignage,cas_etude',
            'statut' => 'required|in:brouillon,publié',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'date_publication' => 'nullable|date',
            'featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        $slug = $validated['slug'] ?: Str::slug($validated['title']);

        if (Actualite::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $published = $validated['statut'] === 'publié';

        $data = [
            'title' => $validated['title'],
            'titre' => $validated['title'],
            'slug' => $slug,
            'extrait' => $validated['extrait'],

            // Compatibilité ancienne/nouvelle structure
            'content' => $validated['content'],
            'description' => $validated['content'],

            'category' => $validated['category'],
            'statut' => $validated['statut'],
            'status' => $validated['statut'],
            'published' => $published,

            'date_publication' => $validated['date_publication'] ?? ($published ? now() : null),
            'featured' => $request->boolean('featured'),

            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,

            'user_id' => $user?->id,
            'team_id' => $this->currentTeamId(),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create($this->onlyExistingColumns($data));

        return redirect()
            ->route('dashboard.actualites.index')
            ->with('success', 'Actualité créée avec succès.');
    }

    public function edit(Actualite $actualite)
    {
        return Inertia::render('Admin/Actualites/Edit', [
            'actualite' => $this->mapActualite($actualite),
            'categories' => $this->categories(),
            'statuts' => [
                'brouillon' => 'Brouillon',
                'publié' => 'Publié',
                'archivé' => 'Archivé',
            ],
        ]);
    }

    public function update(Request $request, Actualite $actualite)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:actualites,slug,' . $actualite->id,
            'extrait' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:actualite,blog,communique,temoignage,cas_etude',
            'statut' => 'required|in:brouillon,publié,archivé',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'date_publication' => 'nullable|date',
            'featured' => 'boolean',
            'remove_image' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $published = $validated['statut'] === 'publié';

        $data = [
            'title' => $validated['title'],
            'titre' => $validated['title'],
            'slug' => $validated['slug'],
            'extrait' => $validated['extrait'],

            // Compatibilité ancienne/nouvelle structure
            'content' => $validated['content'],
            'description' => $validated['content'],

            'category' => $validated['category'],
            'statut' => $validated['statut'],
            'status' => $validated['statut'],
            'published' => $published,

            'date_publication' => $validated['date_publication'] ?? ($published ? now() : null),
            'featured' => $request->boolean('featured'),

            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ];

        if ($request->boolean('remove_image') && $actualite->image) {
            Storage::disk('public')->delete($actualite->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($actualite->image) {
                Storage::disk('public')->delete($actualite->image);
            }

            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite->update($this->onlyExistingColumns($data));

        return redirect()
            ->route('dashboard.actualites.index')
            ->with('success', 'Actualité mise à jour avec succès.');
    }

    public function destroy(Actualite $actualite)
    {
        if ($actualite->image) {
            Storage::disk('public')->delete($actualite->image);
        }

        $actualite->delete();

        return redirect()
            ->route('dashboard.actualites.index')
            ->with('success', 'Actualité supprimée avec succès.');
    }

    public function publish(Actualite $actualite)
    {
        $statusCol = $this->statusColumn();

        $isPublished = ($actualite->{$statusCol} ?? null) === 'publié' || (bool) ($actualite->published ?? false);

        $newStatus = $isPublished ? 'brouillon' : 'publié';

        $data = [
            'statut' => $newStatus,
            'status' => $newStatus,
            'published' => $newStatus === 'publié',
            'date_publication' => $newStatus === 'publié'
                ? ($actualite->date_publication ?? now())
                : $actualite->date_publication,
        ];

        $actualite->update($this->onlyExistingColumns($data));

        return back()->with(
            'success',
            $newStatus === 'publié'
                ? 'Actualité publiée avec succès.'
                : 'Actualité dépubliée avec succès.'
        );
    }

    public function feature(Actualite $actualite)
    {
        if (! $this->columnExists('featured')) {
            return back()->with('error', 'La colonne featured n’existe pas encore dans la table actualites.');
        }

        $featured = ! (bool) $actualite->featured;

        $actualite->update([
            'featured' => $featured,
        ]);

        return back()->with(
            'success',
            $featured
                ? 'Actualité mise en vedette avec succès.'
                : 'Actualité retirée de la vedette.'
        );
    }

    public function togglePublish(Actualite $actualite)
    {
        return $this->publish($actualite);
    }

    public function toggleFeatured(Actualite $actualite)
    {
        return $this->feature($actualite);
    }
}