<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupérer les stats
        $stats = [
            'totalUsers' => User::count(),
            'adminCount' => User::role('Super Admin')->count() + User::role('Administrateur')->count(),
            'managerCount' => User::role('Community Manager')->count() + User::role('Designer')->count(),
            'employeeCount' => User::role('Client')->count(),
            'userRole' => $user->roles->first()?->name ?? 'Utilisateur',
        ];

        // Derniers utilisateurs
        $recentUsers = User::with('roles')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles->first()?->name ?? 'Aucun',
                    'created_at' => $user->created_at->format('d/m/Y H:i'),
                ];
            });

        // Permissions de l'utilisateur
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'permissions' => $permissions,
        ]);
    }
}
