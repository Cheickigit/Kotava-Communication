<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Affiche les paramètres généraux
     */
    public function general()
    {
        $user = Auth::user();
        $team = $user->currentTeam;

        return Inertia::render('Admin/Settings/General', [
            'team' => $team,
            'settings' => [
                'site_name' => config('app.name'),
                'site_url' => config('app.url'),
                'contact_email' => 'contact@kotavacommunication.com',
                'phone' => '+33 70 89 99 00',
                'address' => 'Bénin',
                'timezone' => config('app.timezone'),
                'locale' => config('app.locale'),
            ],
        ]);
    }

    /**
     * Met à jour les paramètres généraux
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_url' => 'required|url',
            'contact_email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'timezone' => 'required|timezone',
            'locale' => 'required|in:fr,en',
        ]);

        // Ici, vous devriez sauvegarder ces paramètres dans la base de données
        // ou dans un fichier de configuration

        return back()->with('success', 'Paramètres généraux mis à jour avec succès !');
    }

    /**
     * Affiche les paramètres SEO
     */
    public function seo()
    {
        return Inertia::render('Admin/Settings/Seo', [
            'seo_settings' => [
                'meta_title' => 'KOTAVA Communication - Agence Premium',
                'meta_description' => 'Agence de communication digitale premium au Bénin',
                'meta_keywords' => 'communication, digital, bénin, agence, marketing',
                'og_image' => null,
                'twitter_card' => 'summary_large_image',
                'robots' => 'index, follow',
            ],
        ]);
    }

    /**
     * Met à jour les paramètres SEO
     */
    public function updateSeo(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'required|string|max:60',
            'meta_description' => 'required|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'twitter_card' => 'required|in:summary,summary_large_image',
            'robots' => 'required|string',
        ]);

        // Sauvegarder les paramètres SEO

        return back()->with('success', 'Paramètres SEO mis à jour avec succès !');
    }

    /**
     * Affiche les paramètres de notifications
     */
    public function notifications()
    {
        $user = Auth::user();

        return Inertia::render('Admin/Settings/Notifications', [
            'notification_settings' => [
                'email_notifications' => true,
                'lead_notifications' => true,
                'project_notifications' => true,
                'weekly_report' => true,
                'marketing_emails' => false,
            ],
        ]);
    }

    /**
     * Met à jour les paramètres de notifications
     */
    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'lead_notifications' => 'boolean',
            'project_notifications' => 'boolean',
            'weekly_report' => 'boolean',
            'marketing_emails' => 'boolean',
        ]);

        // Sauvegarder les préférences de notifications

        return back()->with('success', 'Paramètres de notifications mis à jour avec succès !');
    }

    /**
     * Affiche les paramètres de sécurité
     */
    public function security()
    {
        return Inertia::render('Admin/Settings/Security');
    }

    /**
     * Met à jour le mot de passe
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('success', 'Mot de passe mis à jour avec succès !');
    }

    /**
     * Affiche les logs d'activité
     */
    public function activityLogs(Request $request)
    {
        // Ici, vous devriez récupérer les logs depuis votre système de logging
        $logs = [];

        return Inertia::render('Admin/Settings/ActivityLogs', [
            'logs' => $logs,
        ]);
    }

    /**
     * Affiche les informations système
     */
    public function systemInfo()
    {
        return Inertia::render('Admin/Settings/SystemInfo', [
            'system_info' => [
                'laravel_version' => app()->version(),
                'php_version' => phpversion(),
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
                'database_driver' => config('database.default'),
                'timezone' => config('app.timezone'),
                'debug_mode' => config('app.debug'),
                'environment' => config('app.env'),
                'cache_driver' => config('cache.default'),
                'session_driver' => config('session.driver'),
            ],
        ]);
    }
}
