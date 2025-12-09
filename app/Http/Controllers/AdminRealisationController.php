<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminRealisationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin'); // Limite l'accès aux administrateurs
    }

    public function index()
    {
        // Affiche toutes les réalisations
        $realisations = Realisation::all();
        return Inertia::render('Admin/Realisations', [
            'realisations' => $realisations
        ]);
    }

    public function create()
    {
        // Affiche le formulaire de création de réalisation
        return Inertia::render('Admin/CreateRealisation');
    }

    public function store(Request $request)
    {
        // Valide et crée une nouvelle réalisation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:realisations',
            'client' => 'required|string|max:255',
            'description' => 'required|string', // Ajouter d'autres validations nécessaires
        ]);

        Realisation::create($validated);
        return redirect()->route('admin.realisations.index');
    }

    public function edit(Realisation $realisation)
    {
        // Affiche le formulaire d'édition d'une réalisation
        return Inertia::render('Admin/EditRealisation', [
            'realisation' => $realisation
        ]);
    }

    public function update(Request $request, Realisation $realisation)
    {
        // Valide et met à jour une réalisation existante
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:realisations,slug,' . $realisation->id,
            'client' => 'required|string|max:255',
            'description' => 'required|string', // Ajouter d'autres validations nécessaires
        ]);

        $realisation->update($validated);
        return redirect()->route('admin.realisations.index');
    }

    public function destroy(Realisation $realisation)
    {
        // Supprime une réalisation
        $realisation->delete();
        return redirect()->route('admin.realisations.index');
    }
}
