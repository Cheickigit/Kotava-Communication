<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class TeamController extends Controller
{
    /**
     * Affiche la liste des équipes
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Pour les super-admins, voir toutes les équipes
        if ($user->hasRole('Super Admin')) {
            $teams = Team::with(['owner', 'users'])
                ->latest()
                ->paginate(15);
        } else {
            // Pour les autres, voir seulement leurs équipes
            $teams = $user->teams()
                ->with(['owner', 'users'])
                ->latest()
                ->paginate(15);
        }

        // Statistiques
        $stats = [
            'total_teams' => Team::count(),
            'total_members' => User::count(),
            'personal_teams' => Team::where('personal_team', true)->count(),
            'team_teams' => Team::where('personal_team', false)->count(),
        ];

        return Inertia::render('Admin/Teams/Index', [
            'teams' => $teams,
            'stats' => $stats,
            'can' => [
                'create' => $user->can('create_teams'),
                'edit' => $user->can('edit_teams'),
                'delete' => $user->can('delete_teams'),
                'invite' => $user->can('invite_members'),
            ]
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return Inertia::render('Admin/Teams/Create');
    }

    /**
     * Enregistre une nouvelle équipe
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'personal_team' => 'boolean',
        ]);

        $user = Auth::user();

        $team = Team::create([
            'name' => $validated['name'],
            'personal_team' => $validated['personal_team'] ?? false,
            'user_id' => $user->id,
        ]);

        // Ajouter le créateur comme membre
        $user->teams()->attach($team, ['role' => 'owner']);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Équipe créée avec succès !');
    }

    /**
     * Affiche les détails d'une équipe
     */
    public function show(Team $team)
    {
        $this->authorize('view', $team);

        $team->load(['owner', 'users', 'realisations', 'actualites']);

        return Inertia::render('Admin/Teams/Show', [
            'team' => $team,
            'members' => $team->users()->paginate(10),
            'stats' => [
                'members_count' => $team->users()->count(),
                'projects_count' => $team->realisations()->count(),
                'articles_count' => $team->actualites()->count(),
                'active_projects' => $team->realisations()->where('status', 'en_cours')->count(),
            ]
        ]);
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Team $team)
    {
        $this->authorize('update', $team);

        return Inertia::render('Admin/Teams/Edit', [
            'team' => $team,
        ]);
    }

    /**
     * Met à jour une équipe
     */
    public function update(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team->update($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Équipe mise à jour avec succès !');
    }

    /**
     * Supprime une équipe
     */
    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);

        $team->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', 'Équipe supprimée avec succès !');
    }

    /**
     * Invite un membre à rejoindre l'équipe
     */
    public function inviteMember(Request $request, Team $team)
    {
        $this->authorize('invite', $team);

        $validated = $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:member,admin,editor,viewer',
        ]);

        // Vérifier si l'utilisateur existe
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            // Créer une invitation
            $team->teamInvitations()->create([
                'email' => $validated['email'],
                'role' => $validated['role'],
            ]);

            // Ici, vous devriez envoyer un email d'invitation
            // Mail::to($validated['email'])->send(new TeamInvitation($team, $validated['role']));

            return back()->with('success', 'Invitation envoyée !');
        }

        // Vérifier si l'utilisateur est déjà membre
        if ($team->hasUser($user)) {
            return back()->with('error', 'Cet utilisateur est déjà membre de l\'équipe.');
        }

        // Ajouter l'utilisateur à l'équipe
        $team->users()->attach($user, ['role' => $validated['role']]);

        return back()->with('success', 'Membre ajouté à l\'équipe !');
    }

    /**
     * Retire un membre de l'équipe
     */
    public function removeMember(Team $team, User $user)
    {
        $this->authorize('remove_member', $team);

        // Empêcher de se retirer soi-même si on est le propriétaire
        if ($team->owner_id === $user->id && Auth::id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas vous retirer de votre propre équipe.');
        }

        $team->users()->detach($user);

        return back()->with('success', 'Membre retiré de l\'équipe !');
    }

    /**
     * Change le rôle d'un membre
     */
    public function updateMemberRole(Request $request, Team $team, User $user)
    {
        $this->authorize('update_member_role', $team);

        $validated = $request->validate([
            'role' => 'required|in:member,admin,editor,viewer',
        ]);

        $team->users()->updateExistingPivot($user->id, [
            'role' => $validated['role'],
        ]);

        return back()->with('success', 'Rôle du membre mis à jour !');
    }
}
