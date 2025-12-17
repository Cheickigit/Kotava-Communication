<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teamId = $user->currentTeam->id ?? null;

        $query = User::query();

        // Filtrer par équipe
        if ($teamId) {
            $query->whereHas('teams', function ($q) use ($teamId) {
                $q->where('teams.id', $teamId);
            });
        }

        // Filtres
        if ($request->has('role') && $request->role !== 'tous') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->with(['roles', 'teams'])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // Rôles disponibles
        $roles = Role::all()->pluck('name');

        // Statistiques
        $stats = [
            'total' => User::when($teamId, fn($q) => $q->whereHas('teams', fn($q2) => $q2->where('teams.id', $teamId)))->count(),
            'by_role' => Role::all()->mapWithKeys(function ($role) use ($teamId) {
                $count = User::when($teamId, fn($q) => $q->whereHas('teams', fn($q2) => $q2->where('teams.id', $teamId)))
                    ->role($role->name)
                    ->count();
                return [$role->name => $count];
            }),
        ];

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'filters' => $request->only(['search', 'role']),
            'stats' => $stats,
            'roles' => $roles,
            'can' => [
                'create' => $user->can('create_users'),
                'edit' => $user->can('edit_users'),
                'delete' => $user->can('delete_users'),
                'assign_roles' => $user->can('assign_roles'),
            ]
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $roles = Role::all()->pluck('name');

        return Inertia::render('Admin/Users/Create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(),
        ]);

        // Assigner les rôles
        $user->syncRoles($validated['roles']);

        // Ajouter à l'équipe actuelle
        $currentUser = Auth::user();
        if ($currentUser->currentTeam) {
            $user->teams()->attach($currentUser->currentTeam->id, [
                'role' => 'member'
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::all()->pluck('name');

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user->load('roles'),
            'roles' => $roles,
        ]);
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($validated['password']);
        }

        $user->update($data);

        // Mettre à jour les rôles
        $user->syncRoles($validated['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        // Empêcher la suppression de soi-même
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès !');
    }

    /**
     * Active/désactive un utilisateur
     */
    public function toggleActive(User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $action = $user->is_active ? 'activé' : 'désactivé';

        return back()->with('success', "Utilisateur {$action} avec succès !");
    }
}
