<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>KOTAVA Communication</title>

        <meta name="description" content="KOTAVA Communication est une agence spécialisée en stratégie de communication, branding, design, digital, production audiovisuelle, événementiel, relations publiques et social media.">
        <meta name="keywords" content="KOTAVA Communication, agence de communication, branding, design graphique, stratégie de communication, digital, site web, audiovisuel, social media, événementiel, relations publiques, Bénin, Afrique">
        <meta name="author" content="KOTAVA Communication">
        <meta name="robots" content="index, follow">
        <meta name="theme-color" content="#1E3A8A">
        <meta name="application-name" content="KOTAVA Communication">

        <link rel="canonical" href="{{ url()->current() }}">

        <link rel="icon" type="image/png" href="/logo_horizontal.png">
        <link rel="shortcut icon" type="image/png" href="/logo_horizontal.png">
        <link rel="apple-touch-icon" href="/logo_horizontal.png">

        <meta property="og:type" content="website">
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta property="og:site_name" content="KOTAVA Communication">
        <meta property="og:title" content="KOTAVA Communication — Agence de communication, branding et digital">
        <meta property="og:description" content="Agence de communication spécialisée en stratégie, identité visuelle, digital, audiovisuel, événementiel, relations publiques et social media.">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ url('/logo.png') }}">
        <meta property="og:image:alt" content="KOTAVA Communication">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="KOTAVA Communication — Agence de communication, branding et digital">
        <meta name="twitter:description" content="Agence de communication spécialisée en stratégie, identité visuelle, digital, audiovisuel, événementiel et social media.">
        <meta name="twitter:image" content="{{ url('/logo.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet">

        @php
            $organizationSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'ProfessionalService',
                'name' => 'KOTAVA Communication',
                'url' => url('/'),
                'logo' => url('/logo.png'),
                'image' => url('/logo.png'),
                'email' => 'Contact@kotavacom.com',
                'telephone' => '+33 70 89 99 00',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Porto-Novo',
                    'addressCountry' => 'BJ',
                ],
                'areaServed' => [
                    'Bénin',
                    'Afrique',
                    'International',
                ],
                'serviceType' => [
                    'Stratégie de communication',
                    'Branding',
                    'Design graphique',
                    'Développement web',
                    'Production audiovisuelle',
                    'Événementiel',
                    'Relations publiques',
                    'Social media',
                ],
            ];
        @endphp

        <script type="application/ld+json">
            {!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>

    <body class="font-sans antialiased bg-white text-brand-ink">
        @inertia
    </body>
</html>
