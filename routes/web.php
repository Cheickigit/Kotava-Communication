<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\RealisationController as AdminRealisationController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
use App\Http\Controllers\Admin\TeamController;
use Inertia\Inertia;

/*
|----------------------------------------------------------------------
| Routes Publiques
|----------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages institutionnelles
Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

// Portfolio avec contrôleur
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/portfolio', 'index')->name('portfolio');
    Route::get('/portfolio/{slug}', 'show')->name('portfolio.show');
    Route::get('/api/portfolio/filter', 'filter')->name('api.portfolio.filter');
});

// Blog
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
    Route::get('/blog/{slug}', 'show')->name('blog.show');
});

// À propos
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

// Contact
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'store')->name('contact.store');
});

/*
|----------------------------------------------------------------------
| Routes Dashboard (Protégées)
|----------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('dashboard')->name('dashboard.')->group(function () {

    // Dashboard principal
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');

    // Module Réalisations
    Route::prefix('realisations')->name('realisations.')->controller(AdminRealisationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{realisation}/edit', 'edit')->name('edit');
        Route::put('/{realisation}', 'update')->name('update');
        Route::delete('/{realisation}', 'destroy')->name('destroy');
        Route::post('/{realisation}/publish', 'publish')->name('publish');
        Route::post('/{realisation}/feature', 'feature')->name('feature');
    });

    // Module Actualités/Blog
    Route::prefix('actualites')->name('actualites.')->controller(AdminActualiteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{actualite}/edit', 'edit')->name('edit');
        Route::put('/{actualite}', 'update')->name('update');
        Route::delete('/{actualite}', 'destroy')->name('destroy');
        Route::post('/{actualite}/publish', 'publish')->name('publish');
    });

    // Module Équipe
    Route::prefix('equipe')->name('equipe.')->controller(TeamController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
        Route::post('/{user}/assign-role', 'assignRole')->name('assignRole');
    });

    // Module Leads/Contacts
    Route::prefix('leads')->name('leads.')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Admin/Leads/Index');
        })->name('index');
    });

    // Module Analytics
    Route::prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Admin/Analytics/Index');
        })->name('index');

        // API pour les statistiques
        Route::get('/stats', [AdminDashboardController::class, 'getStats'])->name('stats');
    });

    // Module Paramètres
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Admin/Settings/Index');
        })->name('index');

        Route::get('/general', function () {
            return Inertia::render('Admin/Settings/General');
        })->name('general');

        Route::get('/seo', function () {
            return Inertia::render('Admin/Settings/Seo');
        })->name('seo');
    });

    // Routes API pour le dashboard
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/stats', [AdminDashboardController::class, 'getStats'])->name('stats');
        Route::get('/recent-activities', [AdminDashboardController::class, 'getRecentActivities'])->name('recent-activities');
        Route::get('/project-stats', [AdminRealisationController::class, 'getProjectStats'])->name('project-stats');
    });
});

/*
|----------------------------------------------------------------------
| Routes d'API Publiques
|----------------------------------------------------------------------
*/

Route::prefix('api')->name('api.')->group(function () {
    // API Portfolio public
    Route::get('/portfolio', [PortfolioController::class, 'apiIndex'])->name('portfolio.index');
    Route::get('/portfolio/{slug}', [PortfolioController::class, 'apiShow'])->name('portfolio.show');

    // API Blog public
    Route::get('/blog', [BlogController::class, 'apiIndex'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'apiShow'])->name('blog.show');

    // API Contact
    Route::post('/contact', [ContactController::class, 'apiStore'])->name('contact.store');
});

/*
|----------------------------------------------------------------------
| Routes de fallback et erreurs
|----------------------------------------------------------------------
*/

// Route pour les pages de politique
Route::get('/mentions-legales', function () {
    return Inertia::render('Legal/Mentions');
})->name('legal.mentions');

Route::get('/politique-confidentialite', function () {
    return Inertia::render('Legal/Privacy');
})->name('legal.privacy');

// Route 404 personnalisée
Route::fallback(function () {
    return Inertia::render('Errors/404');
});
