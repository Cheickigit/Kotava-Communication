<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Page d'accueil publique
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages publiques à créer plus tard
Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

Route::get('/portfolio', function () {
    return Inertia::render('Portfolio/Index');
})->name('portfolio');

Route::get('/blog', function () {
    return Inertia::render('Blog/Index');
})->name('blog');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

// Dashboard (protégé par auth)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
