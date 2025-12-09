<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRealisationController;
use App\Http\Controllers\AdminActualiteController;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

// Page d'accueil
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Routes dashboard standard pour les utilisateurs connectés
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Redirection basée sur le rôle
    Route::get('/dashboard', function () {
        $user = auth()->user();

        // Si admin, rediriger vers le dashboard admin
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // Si manager
        if ($user->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        }

        // Dashboard par défaut pour les employés
        return Inertia::render('Dashboard', [
            'stats' => [
                'userRole' => $user->getRoleNames()->first() ?? 'Aucun rôle',
                'permissionsCount' => $user->getAllPermissions()->count(),
            ]
        ]);
    })->name('dashboard');
});

// Routes Admin
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('admin')->group(function () {

    // Route pour le dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Routes pour les réalisations (portfolio)
    Route::resource('realisations', AdminRealisationController::class)
        ->except(['show']); // On gère le show avec une route dédiée dans le controller si nécessaire

    // Routes pour les actualités (blog / news)
    Route::resource('actualites', AdminActualiteController::class)
        ->except(['show']); // On gère le show avec une route dédiée dans le controller si nécessaire
});

// Routes Manager (optionnel)
Route::middleware(['auth:sanctum', 'verified', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        $user = auth()->user();
        return Inertia::render('Manager/Dashboard', [
            'stats' => [
                'userRole' => $user->getRoleNames()->first(),
                'permissionsCount' => $user->getAllPermissions()->count(),
            ]
        ]);
    })->name('manager.dashboard');
});
