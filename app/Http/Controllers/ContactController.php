<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        if (Schema::hasTable('leads')) {
            Lead::create([
                'nom' => $validated['name'],
                'email' => $validated['email'],
                'telephone' => $validated['phone'] ?? null,
                'entreprise' => null,
                'message' => $validated['message'],
                'status' => 'nouveau',
                'service' => $validated['subject'],
                'is_read' => false,
                'source' => 'site_contact',
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 1000),
            ]);
        }

        try {
            if (class_exists(\App\Mail\ContactFormMail::class)) {
                Mail::to('Contact@kotavacom.com')->send(
                    new \App\Mail\ContactFormMail($validated)
                );
            }
        } catch (\Throwable $e) {
            Log::warning('Échec envoi email contact KOTAVA', [
                'message' => $e->getMessage(),
                'email' => $validated['email'],
            ]);
        }

        return back()->with('success', 'Votre message a bien été envoyé. Notre équipe vous répondra rapidement.');
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        if (Schema::hasTable('leads')) {
            Lead::create([
                'nom' => $validated['name'],
                'email' => $validated['email'],
                'telephone' => $validated['phone'] ?? null,
                'entreprise' => null,
                'message' => $validated['message'],
                'status' => 'nouveau',
                'service' => $validated['subject'],
                'is_read' => false,
                'source' => 'api_contact',
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 1000),
            ]);
        }

        return response()->json([
            'message' => 'Votre message a bien été envoyé.',
        ], 201);
    }
}