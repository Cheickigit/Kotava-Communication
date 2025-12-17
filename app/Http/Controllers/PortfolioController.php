<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
use App\Models\Categorie;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Affiche la page portfolio publique
     */
    public function index(Request $request)
    {
        // Récupérer le filtre depuis l'URL (ex: /portfolio?filter=branding)
        $filter = $request->query('filter', 'all');

        // Base query pour les réalisations publiées
        $query = Realisation::where('published', true)
                           ->where('statut', 'publié'); // Utiliser 'statut' français

        // Appliquer le filtre si spécifié (via catégorie)
        if ($filter !== 'all') {
            $query->whereHas('categorie', function($q) use ($filter) {
                $q->where('slug', $filter);
            });
        }

        // Récupérer les réalisations avec pagination
        $realisations = $query->with('categorie')
            ->latest()
            ->paginate(9) // 9 projets par page
            ->withQueryString()
            ->through(function ($realisation) {
                return [
                    'id' => $realisation->id,
                    'title' => $realisation->title,
                    'slug' => $realisation->slug,
                    'description' => $realisation->description,
                    'short_description' => $realisation->summary ?? substr($realisation->description, 0, 150) . '...',
                    'image' => $realisation->image,
                    'client' => $realisation->client,
                    'category' => $realisation->categorie?->name ?? 'Général',
                    'category_slug' => $realisation->categorie?->slug ?? 'general',
                    'status' => $realisation->statut, // Mapper 'statut' vers 'status'
                    'featured' => $realisation->featured,
                    'sector' => $realisation->sector,
                    'country' => $realisation->country,
                    'type' => $realisation->type,
                    'completion_date' => $realisation->completion_date?->format('d/m/Y'),
                    'created_at' => $realisation->created_at->format('d/m/Y'),
                ];
            });

        // Récupérer les catégories disponibles
        $categories = Categorie::whereHas('realisations', function($q) {
            $q->where('published', true)->where('statut', 'publié');
        })->get(['id', 'name', 'slug']);

        // Statistiques pour la page - CORRIGÉES
        $stats = [
            'total_projects' => Realisation::where('published', true)->where('statut', 'publié')->count(),
            'total_clients' => Realisation::where('published', true)->where('statut', 'publié')->distinct('client')->count('client'),
            'ongoing_projects' => Realisation::where('published', true)->where('statut', 'en_cours')->count(), // 'en_cours' pas 'status'
            'completed_projects' => Realisation::where('published', true)->where('statut', 'termine')->count(), // 'termine' pas 'status'
            'featured_projects' => Realisation::where('published', true)->where('statut', 'publié')->where('featured', true)->count(),
        ];

        // Ajouter les statistiques par catégorie
        foreach ($categories as $category) {
            $stats[$category->slug . '_count'] = Realisation::where('published', true)
                ->where('statut', 'publié')
                ->where('categorie_id', $category->id)
                ->count();
        }

        // Calculer le taux de réussite
        $totalCompleted = $stats['completed_projects'];
        $totalAll = $stats['total_projects'];
        $stats['success_rate'] = $totalAll > 0 ? round(($totalCompleted / $totalAll) * 100) : 100;

        // Catégories pour les filtres
        $filterCategories = [
            ['id' => 'all', 'name' => 'Tous les projets', 'count' => $stats['total_projects']],
        ];

        foreach ($categories as $category) {
            $filterCategories[] = [
                'id' => $category->slug,
                'name' => $category->name,
                'count' => $stats[$category->slug . '_count'] ?? 0,
            ];
        }

        // Projets mis en avant
        $featuredProjects = Realisation::where('published', true)
            ->where('statut', 'publié')
            ->where('featured', true)
            ->with('categorie')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($realisation) {
                return [
                    'id' => $realisation->id,
                    'title' => $realisation->title,
                    'slug' => $realisation->slug,
                    'short_description' => $realisation->summary ?? substr($realisation->description, 0, 100) . '...',
                    'image' => $realisation->image,
                    'client' => $realisation->client,
                    'category' => $realisation->categorie?->name ?? 'Général',
                ];
            });

        // Derniers projets
        $recentProjects = Realisation::where('published', true)
            ->where('statut', 'publié')
            ->with('categorie')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($realisation) {
                return [
                    'id' => $realisation->id,
                    'title' => $realisation->title,
                    'slug' => $realisation->slug,
                    'short_description' => $realisation->summary ?? substr($realisation->description, 0, 100) . '...',
                    'image' => $realisation->image,
                    'client' => $realisation->client,
                    'category' => $realisation->categorie?->name ?? 'Général',
                    'status' => $realisation->statut,
                ];
            });

        return Inertia::render('Portfolio/Index', [
            'realisations' => $realisations,
            'featuredProjects' => $featuredProjects,
            'recentProjects' => $recentProjects,
            'stats' => $stats,
            'categories' => $filterCategories,
            'currentFilter' => $filter,
            'filters' => $filterCategories, // Pour le composant Vue
            'meta' => [
                'title' => 'Portfolio - KOTAVA Communication',
                'description' => 'Découvrez nos réalisations en branding, web, social media et production vidéo. Des projets qui transforment les marques.',
                'keywords' => 'portfolio, réalisations, projets, branding, web design, social media, vidéo, communication digitale',
            ]
        ]);
    }

    /**
     * Affiche un projet/une réalisation spécifique
     */
    public function show($slug)
    {
        $realisation = Realisation::with('categorie')
            ->where('slug', $slug)
            ->where('published', true)
            ->where('statut', 'publié')
            ->firstOrFail();

        // Récupérer les projets similaires
        $relatedProjects = Realisation::where('published', true)
            ->where('statut', 'publié')
            ->where('categorie_id', $realisation->categorie_id)
            ->where('id', '!=', $realisation->id)
            ->with('categorie')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'image' => $item->image,
                    'client' => $item->client,
                    'category' => $item->categorie?->name,
                    'short_description' => $item->summary ?? substr($item->description, 0, 100) . '...',
                ];
            });

        // Projet suivant/précédent
        $nextProject = Realisation::where('published', true)
            ->where('statut', 'publié')
            ->where('id', '>', $realisation->id)
            ->orderBy('id', 'asc')
            ->first(['id', 'title', 'slug']);

        $prevProject = Realisation::where('published', true)
            ->where('statut', 'publié')
            ->where('id', '<', $realisation->id)
            ->orderBy('id', 'desc')
            ->first(['id', 'title', 'slug']);

        // Images de la galerie (depuis le champ media JSON)
        $gallery = [];
        if ($realisation->media && is_string($realisation->media)) {
            $gallery = json_decode($realisation->media, true);
        }

        return Inertia::render('Portfolio/Show', [
            'realisation' => [
                'id' => $realisation->id,
                'title' => $realisation->title,
                'slug' => $realisation->slug,
                'client' => $realisation->client,
                'sector' => $realisation->sector,
                'country' => $realisation->country,
                'type' => $realisation->type,
                'completion_date' => $realisation->completion_date?->format('d/m/Y'),
                'summary' => $realisation->summary,
                'description' => $realisation->description,
                'context' => $realisation->context,
                'solution' => $realisation->solution,
                'results' => $realisation->results,
                'client_testimony' => $realisation->client_testimony,
                'image' => $realisation->image,
                'category' => $realisation->categorie?->name,
                'category_slug' => $realisation->categorie?->slug,
                'status' => $realisation->statut,
                'featured' => $realisation->featured,
                'created_at' => $realisation->created_at->format('d/m/Y'),
            ],
            'relatedProjects' => $relatedProjects,
            'nextProject' => $nextProject,
            'prevProject' => $prevProject,
            'gallery' => $gallery,
            'meta' => [
                'title' => $realisation->title . ' - KOTAVA Communication',
                'description' => $realisation->summary ?? substr($realisation->description, 0, 160),
                'image' => $realisation->image,
            ]
        ]);
    }

    /**
     * API pour filtrer les projets (AJAX)
     */
    public function filter(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $page = $request->input('page', 1);

        $query = Realisation::where('published', true)
                           ->where('statut', 'publié');

        if ($filter !== 'all') {
            $query->whereHas('categorie', function($q) use ($filter) {
                $q->where('slug', $filter);
            });
        }

        $realisations = $query->with('categorie')
            ->latest()
            ->paginate(9, ['*'], 'page', $page)
            ->through(function ($realisation) {
                return [
                    'id' => $realisation->id,
                    'title' => $realisation->title,
                    'slug' => $realisation->slug,
                    'description' => $realisation->description,
                    'short_description' => $realisation->summary ?? substr($realisation->description, 0, 150) . '...',
                    'image' => $realisation->image,
                    'client' => $realisation->client,
                    'category' => $realisation->categorie?->name ?? 'Général',
                    'category_slug' => $realisation->categorie?->slug ?? 'general',
                    'status' => $realisation->statut,
                    'featured' => $realisation->featured,
                ];
            });

        return response()->json([
            'realisations' => $realisations,
            'current_filter' => $filter,
        ]);
    }
}
