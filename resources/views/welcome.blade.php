{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Meeqat.io — Smart Hajj & Umrah Companion</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    {{-- Styles & Scripts --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Minimal fallback styles when Vite is not running */
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');

            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: 'Inter', system-ui, sans-serif;
                background-color: #F8FAFC;
                color: #374151;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            a { color: #059669; text-decoration: none; }
            a:hover { color: #047857; }
        </style>
    @endif
</head>
<body class="bg-islamic text-body antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">

        {{-- Navigation --}}
        @if (Route::has('login'))
            <div class="w-full max-w-4xl flex justify-end mb-12">
                <nav class="flex items-center gap-4" aria-label="Authentication">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        @endif

        {{-- Main Content --}}
        <div class="flex flex-col items-center text-center max-w-2xl animate-fade-in">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 mb-10 group"
               aria-label="Meeqat.io — Home">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700
                            flex items-center justify-center
                            shadow-btn group-hover:shadow-glow-green
                            group-hover:scale-105 transition-all duration-300">
                    <span class="text-white font-bold font-heading text-2xl" aria-hidden="true">M</span>
                </div>
                <div class="flex flex-col items-start">
                    <span class="text-heading font-bold font-heading text-2xl leading-none">
                        Meeqat<span class="text-primary-500">.io</span>
                    </span>
                    <span class="text-muted text-caption leading-none mt-1">
                        Smart Hajj & Umrah Companion
                    </span>
                </div>
            </a>

            {{-- Welcome Card --}}
            <div class="card shadow-elevated p-10 w-full max-w-md">

                {{-- Icon --}}
                <div class="w-16 h-16 rounded-2xl bg-primary-50 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                    </svg>
                </div>

                <h1 class="font-heading font-black text-heading text-center mb-2 leading-tight"
                    style="font-size: clamp(1.5rem, 3vw, 2rem);">
                    Welcome to <span class="text-gradient-primary">Meeqat.io</span>
                </h1>

                <p class="text-muted text-body-sm text-center mb-8">
                    Your all-in-one smart companion for Hajj & Umrah. Access calculators, duas, guides, and more.
                </p>

                {{-- Quick Links --}}
                <div class="space-y-3 mb-8">
                    <a href="{{ route('calculator.chaddar') }}" class="card-hover card-body flex items-center gap-3 group p-4">
                        <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-heading text-body-sm font-semibold">Chaddar Calculator</p>
                            <p class="text-muted text-caption">Calculate fabric for Irani Chaddar</p>
                        </div>
                        <svg class="w-4 h-4 text-muted group-hover:text-primary-500 group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>

                    <a href="{{ route('duas.index') }}" class="card-hover card-body flex items-center gap-3 group p-4">
                        <div class="w-10 h-10 rounded-xl bg-secondary-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-heading text-body-sm font-semibold">Duas & Niyat</p>
                            <p class="text-muted text-caption">Browse 500+ Islamic prayers</p>
                        </div>
                        <svg class="w-4 h-4 text-muted group-hover:text-primary-500 group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>

                    <a href="{{ route('meeqat.finder') }}" class="card-hover card-body flex items-center gap-3 group p-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-heading text-body-sm font-semibold">Meeqat Finder</p>
                            <p class="text-muted text-caption">Find nearest Meeqat location</p>
                        </div>
                        <svg class="w-4 h-4 text-muted group-hover:text-primary-500 group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>
                </div>

                {{-- Action Buttons --}}
                <div class="space-y-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary w-full">
                            Go to Dashboard
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary w-full">
                                Create Free Account
                            </a>
                        @endif
                        <a href="{{ route('login') }}" class="btn btn-secondary w-full">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Footer Note --}}
            <p class="mt-8 text-caption text-muted">
                © {{ date('Y') }} Meeqat.io — Made with care for Hajj & Umrah pilgrims
            </p>
        </div>
    </div>

</body>
</html>