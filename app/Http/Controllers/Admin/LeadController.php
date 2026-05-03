<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeadController extends Controller
{
    private function statuts(): array
    {
        return [
            'tous' => 'Tous',
            'nouveau' => 'Nouveau',
            'en_cours' => 'En cours',
            'traité' => 'Traité',
            'archive' => 'Archivé',
        ];
    }

    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('statut') && $request->statut !== 'tous') {
            $query->where('status', $request->statut);
        }

        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $operator = config('database.default') === 'pgsql' ? 'ilike' : 'like';

            $query->where(function ($q) use ($search, $operator) {
                $q->where('nom', $operator, "%{$search}%")
                    ->orWhere('email', $operator, "%{$search}%")
                    ->orWhere('telephone', $operator, "%{$search}%")
                    ->orWhere('entreprise', $operator, "%{$search}%")
                    ->orWhere('service', $operator, "%{$search}%")
                    ->orWhere('message', $operator, "%{$search}%");
            });
        }

        $leads = $query
            ->latest()
            ->paginate(15)
            ->withQueryString()
            ->through(fn (Lead $lead) => [
                'id' => $lead->id,

                // Champs normalisés pour le front
                'name' => $lead->nom,
                'phone' => $lead->telephone,
                'subject' => $lead->service ?: 'Demande de contact',
                'statut' => $lead->status,

                // Champs réels aussi disponibles
                'nom' => $lead->nom,
                'email' => $lead->email,
                'telephone' => $lead->telephone,
                'entreprise' => $lead->entreprise,
                'service' => $lead->service,
                'status' => $lead->status,

                'message' => $lead->message,
                'is_read' => (bool) ($lead->is_read ?? false),
                'source' => $lead->source,
                'ip_address' => $lead->ip_address,
                'created_at' => optional($lead->created_at)->format('d/m/Y H:i'),
                'created_at_human' => optional($lead->created_at)->diffForHumans(),
            ]);

        return Inertia::render('Admin/Leads/Index', [
            'leads' => $leads,
            'filters' => $request->only(['search', 'statut']),
            'statuts' => $this->statuts(),
            'stats' => [
                'total' => Lead::count(),
                'nouveau' => Lead::where('status', 'nouveau')->count(),
                'non_lus' => Lead::where('is_read', false)->count(),
                'traites' => Lead::where('status', 'traité')->count(),
                'archives' => Lead::where('status', 'archive')->count(),
            ],
        ]);
    }

    public function markAsRead(Lead $lead)
    {
        $lead->update([
            'is_read' => true,
            'status' => $lead->status === 'nouveau' ? 'en_cours' : $lead->status,
        ]);

        return back()->with('success', 'Message marqué comme lu.');
    }

    public function archive(Lead $lead)
    {
        $lead->update([
            'is_read' => true,
            'status' => 'archive',
        ]);

        return back()->with('success', 'Message archivé.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return back()->with('success', 'Message supprimé.');
    }
}