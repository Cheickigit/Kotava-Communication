<?php
// app/Http/Controllers/Admin/RealisationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RealisationController extends Controller
{
    /**
     * Affiche la liste des réalisations
     */
    public function index(Request $request)
    {
        // ✅ Colonnes compatibles (Postgres te dit: "statut" existe, pas "status")
        $statusCol      = Schema::hasColumn('realisations', 'statut') ? 'statut' : 'status';
        $titleCol       = Schema::hasColumn('realisations', 'title') ? 'title' : (Schema::hasColumn('realisations', 'titre') ? 'titre' : 'title');
        $descriptionCol = Schema::hasColumn('realisations', 'description') ? 'description' : 'description';
        $clientCol      = Schema::hasColumn('realisations', 'client') ? 'client' : 'client';

        $query = Realisation::query();

        // ✅ Filtres
        if ($request->filled('status') && $request->status !== 'tous') {
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
            $query->where(function ($q) use ($search, $titleCol, $descriptionCol, $clientCol) {
                $q->where($titleCol, 'like', "%{$search}%");

                if ($descriptionCol) {
                    $q->orWhere($descriptionCol, 'like', "%{$search}%");
                }
                if ($clientCol) {
                    $q->orWhere($clientCol, 'like', "%{$search}%");
                }
            });
        }

        $realisations = $query->latest()->paginate(12)->withQueryString();

        // ✅ Stats (sans Team, sans colonne "status")
        $stats = [
            'total'     => Realisation::count(),
            'published' => Schema::hasColumn('realisations', 'published')
                ? Realisation::where('published', true)->count()
                : 0,
            'featured'  => Schema::hasColumn('realisations', 'featured')
                ? Realisation::where('featured', true)->count()
                : 0,
            'en_cours'  => Realisation::where($statusCol, 'en_cours')->count(),
        ];

        $categories = [
            'branding'   => 'Branding',
            'web'        => 'Web & Digital',
            'social'     => 'Social Media',
            'video'      => 'Vidéo',
            'marketing'  => 'Marketing',
            'consulting' => 'Consulting',
        ];

        $statuses = [
            'en_cours'   => 'En cours',
            'termine'    => 'Terminé',
            'en_attente' => 'En attente',
            'annule'     => 'Annulé',
        ];

        return Inertia::render('Admin/Realisations/Index', [
            'realisations' => $realisations,
            'filters'      => $request->only(['search', 'status', 'category', 'published']),
            'stats'        => $stats,
            'categories'   => $categories,
            'statuses'     => $statuses,
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return Inertia::render('Admin/Realisations/Create', [
            'categories' => [
                'branding'   => 'Branding & Identité',
                'web'        => 'Web & Digital',
                'social'     => 'Social Media',
                'video'      => 'Production Vidéo',
                'marketing'  => 'Marketing Stratégique',
                'consulting' => 'Consulting',
            ],
            'statuses' => [
                'en_cours'   => 'En cours',
                'termine'    => 'Terminé',
                'en_attente' => 'En attente',
                'annule'     => 'Annulé',
            ],
            'serviceTypes' => [
                ''               => 'Non spécifié',
                'logo'           => 'Logo',
                'charte'         => 'Charte graphique',
                'site_vitrine'   => 'Site vitrine',
                'ecommerce'      => 'E-commerce',
                'seo'            => 'SEO/SEA',
                'campagne_social'=> 'Campagne réseaux sociaux',
                'community'      => 'Community Management',
                'video_corporate'=> 'Vidéo corporate',
                'motion'         => 'Motion design',
                'evenement'      => 'Événementiel',
                'strategie'      => 'Stratégie digitale',
            ],
        ]);
    }

    /**
     * Enregistre une nouvelle réalisation
     */
    public function store(Request $request)
    {
        $statusCol = Schema::hasColumn('realisations', 'statut') ? 'statut' : 'status';

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:realisations,slug',
            'description' => 'required|string',
            'client'      => 'required|string|max:255',
            'category'    => 'required|in:branding,web,social,video,marketing,consulting',
            'service_type'=> 'nullable|string',
            'status'      => 'required|in:en_cours,termine,en_attente,annule', // input UI
            'published'   => 'boolean',
            'featured'    => 'boolean',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'client_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'budget'      => 'nullable|numeric|min:0',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'testimonial' => 'nullable|string',
            'testimonial_author' => 'nullable|string|max:255',
            'gallery'     => 'nullable|array',
            'gallery.*'   => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title'  => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if (Realisation::where('slug', $slug)->exists()) {
            $slug = $slug.'-'.time();
        }

        $data = [
            'title'       => $validated['title'],
            'slug'        => $slug,
            'description' => $validated['description'],
            'client'      => $validated['client'],
            'category'    => $validated['category'],
            'service_type'=> $validated['service_type'] ?? null,
            $statusCol    => $validated['status'], // ✅ statut/status
            'published'   => $validated['published'] ?? false,
            'featured'    => $validated['featured'] ?? false,
            'budget'      => $validated['budget'] ?? null,
            'start_date'  => $validated['start_date'] ?? null,
            'end_date'    => $validated['end_date'] ?? null,
            'testimonial' => $validated['testimonial'] ?? null,
            'testimonial_author' => $validated['testimonial_author'] ?? null,
            'meta_title'  => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'user_id'     => $user?->id,
        ];

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
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('realisations/gallery', 'public');
            }
            $data['gallery'] = json_encode($galleryPaths);
        }

        $realisation = Realisation::create($data);

        if (!$request->has('metrics') && Schema::hasColumn('realisations', 'metrics')) {
            $realisation->update([
                'metrics' => json_encode([
                    'reach'        => rand(1000, 100000),
                    'engagement'   => rand(5, 50),
                    'conversion'   => rand(1, 20),
                    'satisfaction' => rand(80, 100),
                ]),
            ]);
        }

        return redirect()->route('dashboard.realisations.index')
            ->with('success', 'Réalisation créée avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Realisation $realisation)
    {
        // $this->authorize('update', $realisation);

        return Inertia::render('Admin/Realisations/Edit', [
            'realisation' => $realisation,
            'categories' => [
                'branding'   => 'Branding & Identité',
                'web'        => 'Web & Digital',
                'social'     => 'Social Media',
                'video'      => 'Production Vidéo',
                'marketing'  => 'Marketing Stratégique',
                'consulting' => 'Consulting',
            ],
            'statuses' => [
                'en_cours'   => 'En cours',
                'termine'    => 'Terminé',
                'en_attente' => 'En attente',
                'annule'     => 'Annulé',
            ],
            'serviceTypes' => [
                ''               => 'Non spécifié',
                'logo'           => 'Logo',
                'charte'         => 'Charte graphique',
                'site_vitrine'   => 'Site vitrine',
                'ecommerce'      => 'E-commerce',
                'seo'            => 'SEO/SEA',
                'campagne_social'=> 'Campagne réseaux sociaux',
                'community'      => 'Community Management',
                'video_corporate'=> 'Vidéo corporate',
                'motion'         => 'Motion design',
                'evenement'      => 'Événementiel',
                'strategie'      => 'Stratégie digitale',
            ],
            'gallery_images' => $realisation->gallery ? json_decode($realisation->gallery, true) : [],
        ]);
    }

    /**
     * Met à jour une réalisation
     */
    public function update(Request $request, Realisation $realisation)
    {
        // $this->authorize('update', $realisation);
        $statusCol = Schema::hasColumn('realisations', 'statut') ? 'statut' : 'status';

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:realisations,slug,' . $realisation->id,
            'description' => 'required|string',
            'client'      => 'required|string|max:255',
            'category'    => 'required|in:branding,web,social,video,marketing,consulting',
            'service_type'=> 'nullable|string',
            'status'      => 'required|in:en_cours,termine,en_attente,annule', // input UI
            'published'   => 'boolean',
            'featured'    => 'boolean',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'client_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'budget'      => 'nullable|numeric|min:0',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'testimonial' => 'nullable|string',
            'testimonial_author' => 'nullable|string|max:255',
            'gallery'     => 'nullable|array',
            'gallery.*'   => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_image'=> 'boolean',
            'remove_cover'=> 'boolean',
            'remove_logo' => 'boolean',
            'remove_gallery' => 'nullable|array',
            'meta_title'  => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'metrics'     => 'nullable|array',
        ]);

        $data = [
            'title'       => $validated['title'],
            'slug'        => $validated['slug'],
            'description' => $validated['description'],
            'client'      => $validated['client'],
            'category'    => $validated['category'],
            'service_type'=> $validated['service_type'] ?? null,
            $statusCol    => $validated['status'], // ✅ statut/status
            'published'   => $validated['published'] ?? false,
            'featured'    => $validated['featured'] ?? false,
            'budget'      => $validated['budget'] ?? null,
            'start_date'  => $validated['start_date'] ?? null,
            'end_date'    => $validated['end_date'] ?? null,
            'testimonial' => $validated['testimonial'] ?? null,
            'testimonial_author' => $validated['testimonial_author'] ?? null,
            'meta_title'  => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ];

        if ($request->boolean('remove_image') && $realisation->image) {
            Storage::disk('public')->delete($realisation->image);
            $data['image'] = null;
        }
        if ($request->hasFile('image')) {
            if ($realisation->image) Storage::disk('public')->delete($realisation->image);
            $data['image'] = $request->file('image')->store('realisations', 'public');
        }

        if ($request->boolean('remove_cover') && $realisation->cover_image) {
            Storage::disk('public')->delete($realisation->cover_image);
            $data['cover_image'] = null;
        }
        if ($request->hasFile('cover_image')) {
            if ($realisation->cover_image) Storage::disk('public')->delete($realisation->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('realisations/covers', 'public');
        }

        if ($request->boolean('remove_logo') && $realisation->client_logo) {
            Storage::disk('public')->delete($realisation->client_logo);
            $data['client_logo'] = null;
        }
        if ($request->hasFile('client_logo')) {
            if ($realisation->client_logo) Storage::disk('public')->delete($realisation->client_logo);
            $data['client_logo'] = $request->file('client_logo')->store('realisations/clients', 'public');
        }

        $gallery = $realisation->gallery ? json_decode($realisation->gallery, true) : [];

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

        $data['gallery'] = !empty($gallery) ? json_encode($gallery) : null;

        if ($request->filled('metrics') && Schema::hasColumn('realisations', 'metrics')) {
            $data['metrics'] = json_encode($validated['metrics']);
        }

        $realisation->update($data);

        return redirect()->route('dashboard.realisations.index')
            ->with('success', 'Réalisation mise à jour avec succès !');
    }

    /**
     * Supprime une réalisation
     */
    public function destroy(Realisation $realisation)
    {
        // $this->authorize('delete', $realisation);

        if ($realisation->image) Storage::disk('public')->delete($realisation->image);
        if ($realisation->cover_image) Storage::disk('public')->delete($realisation->cover_image);
        if ($realisation->client_logo) Storage::disk('public')->delete($realisation->client_logo);

        if ($realisation->gallery) {
            foreach ((array) json_decode($realisation->gallery, true) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $realisation->delete();

        return redirect()->route('dashboard.realisations.index')
            ->with('success', 'Réalisation supprimée avec succès !');
    }

    public function togglePublish(Realisation $realisation)
    {
        // $this->authorize('update', $realisation);

        $realisation->update([
            'published' => !$realisation->published,
        ]);

        $action = $realisation->published ? 'publiée' : 'dépubliée';

        return back()->with('success', "Réalisation {$action} avec succès !");
    }

    public function toggleFeatured(Realisation $realisation)
    {
        // $this->authorize('update', $realisation);

        $realisation->update([
            'featured' => !$realisation->featured,
        ]);

        $action = $realisation->featured ? 'mise en vedette' : 'retirée de la vedette';

        return back()->with('success', "Réalisation {$action} avec succès !");
    }
}
