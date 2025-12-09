<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminActualiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin'); // Limite l'accès aux administrateurs
    }

    public function index()
    {
        // Affiche toutes les actualités
        $actualites = Actualite::all();
        return Inertia::render('Admin/Actualites', [
            'actualites' => $actualites
        ]);
    }

    public function create()
    {
        // Affiche le formulaire de création d'actualité
        return Inertia::render('Admin/CreateActualite');
    }

    public function store(Request $request)
    {
        // Valide et crée une nouvelle actualité
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:actualites',
            'content' => 'required|string', // Ajouter d'autres validations nécessaires
        ]);

        Actualite::create($validated);
        return redirect()->route('admin.actualites.index');
    }

    public function edit(Actualite $actualite)
    {
        // Affiche le formulaire d'édition d'une actualité
        return Inertia::render('Admin/EditActualite', [
            'actualite' => $actualite
        ]);
    }

    public function update(Request $request, Actualite $actualite)
    {
        // Valide et met à jour une actualité existante
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:actualites,slug,' . $actualite->id,
            'content' => 'required|string', // Ajouter d'autres validations nécessaires
        ]);

        $actualite->update($validated);
        return redirect()->route('admin.actualites.index');
    }

    public function destroy(Actualite $actualite)
    {
        // Supprime une actualité
        $actualite->delete();
        return redirect()->route('admin.actualites.index');
    }
}
