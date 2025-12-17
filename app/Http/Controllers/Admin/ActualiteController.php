<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ActualiteController extends Controller
{
    /**
     * Affiche la liste des actualités
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $query = Actualite::query();

        // Filtrer par équipe
        if ($teamId) {
            $query->where('team_id', $teamId);
        }

        // Filtres
        if ($request->has('statut') && $request->statut !== 'tous') {
            $query->where('statut', $request->statut);
        }

        if ($request->has('category') && $request->category !== 'tous') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('extrait', 'like', "%{$search}%");
            });
        }

        $actualites = $query->latest('date_publication')
            ->paginate(15)
            ->withQueryString();

        // Statistiques
        $stats = [
            'total' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))->count(),
            'publie' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('statut', 'publié')->count(),
            'brouillon' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('statut', 'brouillon')->count(),
            'featured' => Actualite::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('featured', true)->count(),
        ];

        $categories = [
            'actualite' => 'Actualité',
            'blog' => 'Article Blog',
            'communique' => 'Communiqué',
            'temoignage' => 'Témoignage',
            'cas_etude' => 'Cas d\'étude',
        ];

        $statuts = [
            'tous' => 'Tous',
            'brouillon' => 'Brouillon',
            'publié' => 'Publié',
            'archivé' => 'Archivé',
        ];

        return Inertia::render('Admin/Actualites/Index', [
            'actualites' => $actualites,
            'filters' => $request->only(['search', 'statut', 'category']),
            'stats' => $stats,
            'categories' => $categories,
            'statuts' => $statuts,
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return Inertia::render('Admin/Actualites/Create', [
            'categories' => [
                'actualite' => 'Actualité',
                'blog' => 'Article Blog',
                'communique' => 'Communiqué',
                'temoignage' => 'Témoignage Client',
                'cas_etude' => 'Cas d\'étude',
            ],
            'statuts' => [
                'brouillon' => 'Brouillon',
                'publié' => 'Publié',
            ],
        ]);
    }

    /**
     * Enregistre une nouvelle actualité
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:actualites,slug',
            'extrait' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:actualite,blog,communique,temoignage,cas_etude',
            'statut' => 'required|in:brouillon,publié',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date_publication' => 'nullable|date',
            'featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        // Générer le slug
        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if (Actualite::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $data = [
            'title' => $validated['title'],
            'slug' => $slug,
            'extrait' => $validated['extrait'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'statut' => $validated['statut'],
            'date_publication' => $validated['date_publication'] ?? now(),
            'featured' => $validated['featured'] ?? false,
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'user_id' => $user->id,
            'team_id' => $user->currentTeam->id ?? null,
        ];

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create($data);

        return redirect()->route('admin.actualites.index')
            ->with('success', 'Actualité créée avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Actualite $actualite)
    {
        $this->authorize('update', $actualite);

        return Inertia::render('Admin/Actualites/Edit', [
            'actualite' => $actualite,
            'categories' => [
                'actualite' => 'Actualité',
                'blog' => 'Article Blog',
                'communique' => 'Communiqué',
                'temoignage' => 'Témoignage Client',
                'cas_etude' => 'Cas d\'étude',
            ],
            'statuts' => [
                'brouillon' => 'Brouillon',
                'publié' => 'Publié',
                'archivé' => 'Archivé',
            ],
        ]);
    }

    /**
     * Met à jour une actualité
     */
    public function update(Request $request, Actualite $actualite)
    {
        $this->authorize('update', $actualite);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:actualites,slug,' . $actualite->id,
            'extrait' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|in:actualite,blog,communique,temoignage,cas_etude',
            'statut' => 'required|in:brouillon,publié,archivé',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date_publication' => 'nullable|date',
            'featured' => 'boolean',
            'remove_image' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'extrait' => $validated['extrait'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'statut' => $validated['statut'],
            'date_publication' => $validated['date_publication'],
            'featured' => $validated['featured'] ?? false,
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
        ];

        // Gestion de l'image
        if ($request->has('remove_image') && $actualite->image) {
            Storage::disk('public')->delete($actualite->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($actualite->image) {
                Storage::disk('public')->delete($actualite->image);
            }
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite->update($data);

        return redirect()->route('admin.actualites.index')
            ->with('success', 'Actualité mise à jour avec succès !');
    }

    /**
     * Supprime une actualité
     */
    public function destroy(Actualite $actualite)
    {
        $this->authorize('delete', $actualite);

        if ($actualite->image) {
            Storage::disk('public')->delete($actualite->image);
        }

        $actualite->delete();

        return redirect()->route('admin.actualites.index')
            ->with('success', 'Actualité supprimée avec succès !');
    }

    /**
     * Change le statut de publication
     */
    public function togglePublish(Actualite $actualite)
    {
        $this->authorize('update', $actualite);

        $actualite->update([
            'statut' => $actualite->statut === 'publié' ? 'brouillon' : 'publié',
        ]);

        $action = $actualite->statut === 'publié' ? 'publiée' : 'dépubliée';

        return back()->with('success', "Actualité {$action} avec succès !");
    }

    /**
     * Change le statut "featured"
     */
    public function toggleFeatured(Actualite $actualite)
    {
        $this->authorize('update', $actualite);

        $actualite->update([
            'featured' => !$actualite->featured,
        ]);

        $action = $actualite->featured ? 'mise en vedette' : 'retirée de la vedette';

        return back()->with('success', "Actualité {$action} avec succès !");
    }
}
