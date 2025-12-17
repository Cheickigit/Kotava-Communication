<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $actualites = Actualite::where('statut', 'publié')
            ->latest('date_publication')
            ->get();

        return Inertia::render('Blog/Index', [
            'actualites' => $actualites,
        ]);
    }

    public function show($slug)
    {
        $actualite = Actualite::where('slug', $slug)
            ->where('statut', 'publié')
            ->firstOrFail();

        return Inertia::render('Blog/Show', [
            'actualite' => $actualite,
        ]);
    }
}
