<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class RealisationController extends Controller
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

    private function categories(): array
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

    private function statuses(): array
    {
        return [
            'brouillon'   => 'Brouillon',
            'en_cours'   => 'En cours',
            'publié'      => 'Publié',
            'termine'    => 'Terminé',
            'en_attente' => 'En attente',
            'annule'     => 'Annulé',
            'archive'    => 'Archivé',
        ];
    }

    private function serviceTypes(): array
    {
        return [
            ''                => 'Non spécifié',
            'logo'            => 'Logo',
            'charte'          => 'Charte graphique',
            'site_vitrine'    => 'Site vitrine',
            'ecommerce'       => 'E-commerce',
            'seo'             => 'SEO/SEA',
            'campagne_social' => 'Campagne réseaux sociaux',
            'community'       => 'Community Management',
            'video_corporate' => 'Vidéo corporate',
            'motion'          => 'Motion design',
            'evenement'       => 'Événementiel',
            'strategie'       => 'Stratégie digitale',
        ];
    }

    private function onlyExistingColumns(array $data): array
    {
        return collect($data)
            ->filter(fn ($value, $key) => Schema::hasColumn('realisations', $key))
            ->toArray();
    }

    private function galleryToArray($gallery): array
    {
        if (is_array($gallery)) {
            return $gallery;
        }

        if (is_string($gallery) && $gallery !== '') {
            $decoded = json_decode($gallery, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    private function buildLegacyData(array $validated): array
    {
        $description = $validated['description'];
        $summary = Str::limit(strip_tags($description), 220);

        $categoryLabels = [
            'branding'   => 'Branding & Identité',
            'web'        => 'Web & Digital',
            'social'     => 'Social Media',
            'video'      => 'Production audiovisuelle',
            'marketing'  => 'Marketing stratégique',
            'consulting' => 'Conseil & stratégie',
        ];

        $serviceLabels = [
            'logo'            => 'Logo',
            'charte'          => 'Charte graphique',
            'site_vitrine'    => 'Site vitrine',
            'ecommerce'       => 'E-commerce',
            'seo'             => 'SEO/SEA',
            'campagne_social' => 'Campagne réseaux sociaux',
            'community'       => 'Community Management',
            'video_corporate' => 'Vidéo corporate',
            'motion'          => 'Motion design',
            'evenement'       => 'Événementiel',
            'strategie'       => 'Stratégie digitale',
        ];

        return [
            'sector'            => $categoryLabels[$validated['category']] ?? 'Communication',
            'country'           => 'Bénin',
            'type'              => $serviceLabels[$validated['service_type'] ?? ''] ?? 'Projet de communication',
            'completion_date'   => $validated['end_date'] ?? $validated['start_date'] ?? now()->toDateString(),
            'summary'           => $summary,
            'short_description' => $summary,
            'context'           => $description,
            'solution'          => $description,
            'results'           => $validated['testimonial'] ?? 'Réalisation livrée avec succès.',
            'client_testimony'  => $validated['testimonial'] ?? null,
        ];
    }

    private function resolveCategorieId(string $category): int
    {
        $labels = $this->categories();
        $label = $labels[$category] ?? 'Communication';

        if (Schema::hasTable('categories')) {
            $existingCategory = DB::table('categories')
                ->where('slug', $category)
                ->orWhere('name', $label)
                ->first();

            if ($existingCategory) {
                return (int) $existingCategory->id;
            }

            $insertData = [
                'name'       => $label,
                'slug'       => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (Schema::hasColumn('categories', 'description')) {
                $insertData['description'] = null;
            }

            if (Schema::hasColumn('categories', 'active')) {
                $insertData['active'] = true;
            }

            if (Schema::hasColumn('categories', 'ordre')) {
                $insertData['ordre'] = 0;
            }

            return (int) DB::table('categories')->insertGetId($insertData);
        }

        return 1;
    }

    private function buildMediaPayload(array $data, array $gallery = []): array
    {
        $media = [];

        if (!empty($data['image'])) {
            $media[] = [
                'type' => 'image',
                'label' => 'Image principale',
                'path' => $data['image'],
            ];
        }

        if (!empty($data['cover_image'])) {
            $media[] = [
                'type' => 'cover',
                'label' => 'Image de couverture',
                'path' => $data['cover_image'],
            ];
        }

        if (!empty($data['client_logo'])) {
            $media[] = [
                'type' => 'client_logo',
                'label' => 'Logo client',
                'path' => $data['client_logo'],
            ];
        }

        foreach ($gallery as $image) {
            $media[] = [
                'type' => 'gallery',
                'label' => 'Galerie',
                'path' => $image,
            ];
        }

        return $media;
    }

    public function index(Request $request)
    {
        $statusCol = $this->statusColumn();
        $likeOperator = config('database.default') === 'pgsql' ? 'ilike' : 'like';

        $query = Realisation::query();

        if ($request->filled('status') && $request->status !== 'tous' && $statusCol) {
            $query->where($statusCol, $request->status);
        }

        if ($request->filled('category') && $request->category !== 'tous' && Schema::hasColumn('realisations', 'category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('published') && $request->published !== 'tous' && Schema::hasColumn('realisations', 'published')) {
            $query->where('published', $request->published === 'oui');
        }

        if ($request->filled('search')) {
            $search = trim((string) $request->search);

            $query->where(function ($q) use ($search, $likeOperator) {
                if (Schema::hasColumn('realisations', 'title')) {
                    $q->where('title', $likeOperator, "%{$search}%");
                }

                if (Schema::hasColumn('realisations', 'description')) {
                    $q->orWhere('description', $likeOperator, "%{$search}%");
                }

                if (Schema::hasColumn('realisations', 'client')) {
                    $q->orWhere('client', $likeOperator, "%{$search}%");
                }

                if (Schema::hasColumn('realisations', 'sector')) {
                    $q->orWhere('sector', $likeOperator, "%{$search}%");
                }
            });
        }

        $realisations = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => Realisation::count(),

            'published' => Schema::hasColumn('realisations', 'published')
                ? Realisation::where('published', true)->count()
                : 0,

            'featured' => Schema::hasColumn('realisations', 'featured')
                ? Realisation::where('featured', true)->count()
                : 0,

            'en_cours' => $statusCol
                ? Realisation::where($statusCol, 'en_cours')->count()
                : 0,
        ];

        return Inertia::render('Admin/Realisations/Index', [
            'realisations' => $realisations,
            'filters'      => $request->only(['search', 'status', 'category', 'published']),
            'stats'        => $stats,
            'categories'   => $this->categories(),
            'statuses'     => $this->statuses(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Realisations/Create', [
            'categories'   => $this->categories(),
            'statuses'     => $this->statuses(),
            'serviceTypes' => $this->serviceTypes(),
        ]);
    }

    public function store(Request $request)
    {
        $statusCol = $this->statusColumn();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:realisations,slug',
            'description' => 'required|string',
            'client'      => 'required|string|max:255',

            'category'     => 'required|in:branding,web,social,video,marketing,consulting',
            'service_type' => 'nullable|string|max:255',
            'status'       => 'required|in:brouillon,en_cours,publié,termine,en_attente,annule,archive,draft',

            'published' => 'boolean',
            'featured'  => 'boolean',

            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'client_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'budget'     => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',

            'testimonial'        => 'nullable|string',
            'testimonial_author' => 'nullable|string|max:255',

            'gallery'   => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        $slug = $validated['slug'] ?: Str::slug($validated['title']);

        if (Realisation::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $published = $request->boolean('published');
        $featured = $request->boolean('featured');
        $statusForDb = $published ? 'publié' : $validated['status'];

        $data = [
            'title'       => $validated['title'],
            'slug'        => $slug,
            'description' => $validated['description'],
            'client'      => $validated['client'],

            'category'     => $validated['category'],
            'service_type' => $validated['service_type'] ?? null,

            'published' => $published,
            'featured'  => $featured,

            'budget'     => $validated['budget'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date'   => $validated['end_date'] ?? null,

            'testimonial'        => $validated['testimonial'] ?? null,
            'testimonial_author' => $validated['testimonial_author'] ?? null,
            'client_testimony'   => $validated['testimonial'] ?? null,

            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,

            'media'        => [],
            'categorie_id' => $this->resolveCategorieId($validated['category']),

            'user_id' => $user?->id,
        ];

        if ($statusCol) {
            $data[$statusCol] = $statusForDb;
        }

        $data = array_merge($data, $this->buildLegacyData($validated));

        $galleryPaths = [];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('realisations', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('realisations/covers', 'public');
        }

        if ($request->hasFile('client_logo')) {
            $data['client_logo'] = $request->file('client_logo')->store('realisations/clients', 'public');
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('realisations/gallery', 'public');
            }

            $data['gallery'] = $galleryPaths;
        }

        $data['media'] = $this->buildMediaPayload($data, $galleryPaths);

        if (Schema::hasColumn('realisations', 'metrics')) {
            $data['metrics'] = [
                'reach'        => rand(1000, 100000),
                'engagement'   => rand(5, 50),
                'conversion'   => rand(1, 20),
                'satisfaction' => rand(80, 100),
            ];
        }

        Realisation::create($this->onlyExistingColumns($data));

        return redirect()
            ->route('dashboard.realisations.index')
            ->with('success', 'Réalisation créée avec succès.');
    }

    public function edit(Realisation $realisation)
    {
        return Inertia::render('Admin/Realisations/Edit', [
            'realisation'    => $realisation,
            'categories'     => $this->categories(),
            'statuses'       => $this->statuses(),
            'serviceTypes'   => $this->serviceTypes(),
            'gallery_images' => $this->galleryToArray($realisation->gallery),
        ]);
    }

    public function update(Request $request, Realisation $realisation)
    {
        $statusCol = $this->statusColumn();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:realisations,slug,' . $realisation->id,
            'description' => 'required|string',
            'client'      => 'required|string|max:255',

            'category'     => 'required|in:branding,web,social,video,marketing,consulting',
            'service_type' => 'nullable|string|max:255',
            'status'       => 'required|in:brouillon,en_cours,publié,termine,en_attente,annule,archive,draft',

            'published' => 'boolean',
            'featured'  => 'boolean',

            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'client_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'budget'     => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',

            'testimonial'        => 'nullable|string',
            'testimonial_author' => 'nullable|string|max:255',

            'gallery'   => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'remove_image'   => 'boolean',
            'remove_cover'   => 'boolean',
            'remove_logo'    => 'boolean',
            'remove_gallery' => 'nullable|array',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'metrics'          => 'nullable|array',
        ]);

        $published = $request->boolean('published');
        $featured = $request->boolean('featured');
        $statusForDb = $published ? 'publié' : $validated['status'];

        $data = [
            'title'       => $validated['title'],
            'slug'        => $validated['slug'],
            'description' => $validated['description'],
            'client'      => $validated['client'],

            'category'     => $validated['category'],
            'service_type' => $validated['service_type'] ?? null,

            'published' => $published,
            'featured'  => $featured,

            'budget'     => $validated['budget'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date'   => $validated['end_date'] ?? null,

            'testimonial'        => $validated['testimonial'] ?? null,
            'testimonial_author' => $validated['testimonial_author'] ?? null,
            'client_testimony'   => $validated['testimonial'] ?? null,

            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,

            'categorie_id' => $realisation->categorie_id ?: $this->resolveCategorieId($validated['category']),
        ];

        if ($statusCol) {
            $data[$statusCol] = $statusForDb;
        }

        $data = array_merge($data, $this->buildLegacyData($validated));

        if ($request->boolean('remove_image') && $realisation->image) {
            Storage::disk('public')->delete($realisation->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($realisation->image) {
                Storage::disk('public')->delete($realisation->image);
            }

            $data['image'] = $request->file('image')->store('realisations', 'public');
        }

        if ($request->boolean('remove_cover') && $realisation->cover_image) {
            Storage::disk('public')->delete($realisation->cover_image);
            $data['cover_image'] = null;
        }

        if ($request->hasFile('cover_image')) {
            if ($realisation->cover_image) {
                Storage::disk('public')->delete($realisation->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('realisations/covers', 'public');
        }

        if ($request->boolean('remove_logo') && $realisation->client_logo) {
            Storage::disk('public')->delete($realisation->client_logo);
            $data['client_logo'] = null;
        }

        if ($request->hasFile('client_logo')) {
            if ($realisation->client_logo) {
                Storage::disk('public')->delete($realisation->client_logo);
            }

            $data['client_logo'] = $request->file('client_logo')->store('realisations/clients', 'public');
        }

        $gallery = $this->galleryToArray($realisation->gallery);

        if ($request->filled('remove_gallery')) {
            foreach ((array) $request->remove_gallery as $imageToRemove) {
                if (($key = array_search($imageToRemove, $gallery, true)) !== false) {
                    Storage::disk('public')->delete($imageToRemove);
                    unset($gallery[$key]);
                }
            }

            $gallery = array_values($gallery);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('realisations/gallery', 'public');
            }
        }

        $data['gallery'] = !empty($gallery) ? $gallery : null;
        $data['media'] = $this->buildMediaPayload($data, $gallery);

        if ($request->filled('metrics') && Schema::hasColumn('realisations', 'metrics')) {
            $data['metrics'] = $validated['metrics'];
        }

        $realisation->update($this->onlyExistingColumns($data));

        return redirect()
            ->route('dashboard.realisations.index')
            ->with('success', 'Réalisation mise à jour avec succès.');
    }

    public function destroy(Realisation $realisation)
    {
        if ($realisation->image) {
            Storage::disk('public')->delete($realisation->image);
        }

        if ($realisation->cover_image) {
            Storage::disk('public')->delete($realisation->cover_image);
        }

        if ($realisation->client_logo) {
            Storage::disk('public')->delete($realisation->client_logo);
        }

        foreach ($this->galleryToArray($realisation->gallery) as $image) {
            Storage::disk('public')->delete($image);
        }

        $realisation->delete();

        return redirect()
            ->route('dashboard.realisations.index')
            ->with('success', 'Réalisation supprimée avec succès.');
    }

    public function publish(Realisation $realisation)
    {
        $statusCol = $this->statusColumn();

        $published = ! (bool) $realisation->published;

        $data = [
            'published' => $published,
        ];

        if ($statusCol) {
            $data[$statusCol] = $published ? 'publié' : 'brouillon';
        }

        $realisation->update($this->onlyExistingColumns($data));

        return back()->with(
            'success',
            $published
                ? 'Réalisation publiée avec succès.'
                : 'Réalisation dépubliée avec succès.'
        );
    }

    public function feature(Realisation $realisation)
    {
        if (! Schema::hasColumn('realisations', 'featured')) {
            return back()->with('error', 'La colonne featured n’existe pas dans la table réalisations.');
        }

        $featured = ! (bool) $realisation->featured;

        $realisation->update([
            'featured' => $featured,
        ]);

        return back()->with(
            'success',
            $featured
                ? 'Réalisation mise en avant avec succès.'
                : 'Réalisation retirée de la mise en avant.'
        );
    }

    public function togglePublish(Realisation $realisation)
    {
        return $this->publish($realisation);
    }

    public function toggleFeatured(Realisation $realisation)
    {
        return $this->feature($realisation);
    }
}