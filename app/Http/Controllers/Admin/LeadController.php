<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Affiche la liste des leads
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $query = Lead::query();

        // Filtrer par équipe
        if ($teamId) {
            $query->where('team_id', $teamId);
        }

        // Filtres
        if ($request->has('status') && $request->status !== 'tous') {
            $query->where('status', $request->status);
        }

        if ($request->has('service') && $request->service !== 'tous') {
            $query->where('service', $request->service);
        }

        if ($request->has('source') && $request->source !== 'tous') {
            $query->where('source', $request->source);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $leads = $query->latest()
            ->paginate(20)
            ->withQueryString();

        // Statistiques
        $stats = [
            'total' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->count(),
            'nouveau' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'nouveau')->count(),
            'en_contact' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'en_contact')->count(),
            'devis_envoye' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'devis_envoye')->count(),
            'convertis' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'convertis')->count(),
            'perdus' => Lead::when($teamId, fn($q) => $q->where('team_id', $teamId))->where('status', 'perdus')->count(),
        ];

        $statuses = [
            'nouveau' => 'Nouveau',
            'en_contact' => 'En contact',
            'devis_envoye' => 'Devis envoyé',
            'negociation' => 'Négociation',
            'convertis' => 'Converti',
            'perdus' => 'Perdu',
        ];

        $sources = [
            'site_web' => 'Site web',
            'reseaux_sociaux' => 'Réseaux sociaux',
            'recommandation' => 'Recommandation',
            'salon' => 'Salon/Événement',
            'emailing' => 'Emailing',
            'autre' => 'Autre',
        ];

        $services = [
            'branding' => 'Branding',
            'web' => 'Site web',
            'social' => 'Social Media',
            'video' => 'Vidéo',
            'marketing' => 'Marketing',
            'consulting' => 'Consulting',
            'pack_complet' => 'Pack complet',
        ];

        return Inertia::render('Admin/Leads/Index', [
            'leads' => $leads,
            'filters' => $request->only(['search', 'status', 'service', 'source']),
            'stats' => $stats,
            'statuses' => $statuses,
            'sources' => $sources,
            'services' => $services,
        ]);
    }

    /**
     * Affiche les détails d'un lead
     */
    public function show(Lead $lead)
    {
        $this->authorize('view', $lead);

        return Inertia::render('Admin/Leads/Show', [
            'lead' => $lead,
        ]);
    }

    /**
     * Met à jour le statut d'un lead
     */
    public function updateStatus(Request $request, Lead $lead)
    {
        $this->authorize('update', $lead);

        $validated = $request->validate([
            'status' => 'required|in:nouveau,en_contact,devis_envoye,negociation,convertis,perdus',
            'notes' => 'nullable|string',
        ]);

        $lead->update([
            'status' => $validated['status'],
        ]);

        // Ajouter une note si fournie
        if ($request->filled('notes')) {
            $lead->notes()->create([
                'content' => $validated['notes'],
                'user_id' => Auth::id(),
            ]);
        }

        return back()->with('success', 'Statut du lead mis à jour !');
    }

    /**
     * Ajoute une note à un lead
     */
    public function addNote(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $lead->notes()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Note ajoutée !');
    }

    /**
     * Supprime un lead
     */
    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);

        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead supprimé avec succès !');
    }

    /**
     * Exporte les leads
     */
    public function export(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $query = Lead::query();

        if ($teamId) {
            $query->where('team_id', $teamId);
        }

        // Appliquer les mêmes filtres que l'index
        if ($request->has('status') && $request->status !== 'tous') {
            $query->where('status', $request->status);
        }

        $leads = $query->get();

        // Créer le CSV
        $csv = \League\Csv\Writer::createFromString('');
        $csv->insertOne(['Nom', 'Email', 'Téléphone', 'Entreprise', 'Service', 'Statut', 'Source', 'Date']);

        foreach ($leads as $lead) {
            $csv->insertOne([
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->company,
                $lead->service,
                $lead->status,
                $lead->source,
                $lead->created_at->format('d/m/Y H:i'),
            ]);
        }

        return response($csv->toString(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="leads_' . date('Y-m-d') . '.csv"',
        ]);
    }
}
