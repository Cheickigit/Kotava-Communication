<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Services/Index');
    }

    public function strategie()
    {
        return Inertia::render('Services/Strategie');
    }

    public function branding()
    {
        return Inertia::render('Services/Branding');
    }

    public function digital()
    {
        return Inertia::render('Services/Digital');
    }

    public function audiovisuel()
    {
        return Inertia::render('Services/Audiovisuel');
    }

    public function evenementiel()
    {
        return Inertia::render('Services/Evenementiel');
    }

    public function social()
    {
        return Inertia::render('Services/Social');
    }
}
