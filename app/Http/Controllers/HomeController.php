<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 6 dernières réalisations publiées et mises en avant
        $realisations = Realisation::where('published', true)
            ->where('featured', true)
            ->latest()
            ->take(6)
            ->get(['id', 'title as titre', 'slug', 'description', 'image', 'client']);

        // Récupérer les 3 dernières actualités publiées
        // CORRECTION: utiliser 'statut' au lieu de 'published'
        $actualites = Actualite::where('statut', 'publié')
            ->latest('date_publication')
            ->take(3)
            ->get(['id', 'title as titre', 'slug', 'extrait', 'image', 'date_publication as date']);

        // Statistiques
        $stats = [
            'total_realisations' => Realisation::where('published', true)->count(),
            'total_actualites' => Actualite::where('statut', 'publié')->count(),
            'total_clients' => Realisation::where('published', true)
                ->distinct('client')
                ->count('client'),
        ];

        return Inertia::render('Home', [
            'realisations' => $realisations,
            'actualites' => $actualites,
            'stats' => $stats,
        ]);
    }
}
