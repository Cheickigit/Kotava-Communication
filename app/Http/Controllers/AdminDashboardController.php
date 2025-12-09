<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    /**
     * Afficher le tableau de bord administrateur
     */
    public function index(): Response
    {
        $user = auth()->user();

        // Statistiques pour le dashboard
        $stats = [
            'totalUsers' => User::count(),
            'userRole' => $user->getRoleNames()->first() ?? 'Aucun rôle',
            'permissionsCount' => $user->getAllPermissions()->count(),
            'adminCount' => User::role('admin')->count(),
            'managerCount' => User::role('manager')->count(),
            'employeeCount' => User::role('employee')->count(),
        ];

        // Récupérer les derniers utilisateurs
        $recentUsers = User::latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->getRoleNames()->first() ?? 'Aucun',
                    'created_at' => $user->created_at->diffForHumans(),
                ];
            });

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    }
}
