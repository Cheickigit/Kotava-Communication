<?php


// app/Http/Controllers/AdminRealisationController.php

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
        $realisations = Realisation::all();
        return Inertia::render('Admin/Realisations', [
            'realisations' => $realisations
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/CreateRealisation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:realisations',
            'client' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'summary' => 'required|string',
            'description' => 'required|string',
            'context' => 'required|string',
            'solution' => 'required|string',
            'results' => 'required|string',
            'media' => 'nullable|array',
        ]);

        Realisation::create($validated);
        return redirect()->route('admin.realisations.index');
    }

    public function edit(Realisation $realisation)
    {
        return Inertia::render('Admin/EditRealisation', [
            'realisation' => $realisation
        ]);
    }

    public function update(Request $request, Realisation $realisation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:realisations,slug,' . $realisation->id,
            'client' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'summary' => 'required|string',
            'description' => 'required|string',
            'context' => 'required|string',
            'solution' => 'required|string',
            'results' => 'required|string',
            'media' => 'nullable|array',
        ]);

        $realisation->update($validated);
        return redirect()->route('admin.realisations.index');
    }

    public function destroy(Realisation $realisation)
    {
        $realisation->delete();
        return redirect()->route('admin.realisations.index');
    }
}
