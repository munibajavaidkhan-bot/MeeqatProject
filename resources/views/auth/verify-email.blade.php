<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email — Meeqat.io</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-950 min-h-screen font-sans antialiased" x-data>

    {{-- Background --}}
    <div class="fixed inset-0 bg-mesh"></div>
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -left-40 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 -right-40 w-96 h-96 bg-gold-500/8 rounded-full blur-3xl animate-pulse-slow" style="animation-delay:2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary-500/5 rounded-full blur-3xl"></div>

        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 50px 50px;">
        </div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-md animate-slide-up text-center">

            {{-- Mobile Logo --}}
            <div class="lg:hidden flex items-center justify-center gap-3 mb-10">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-glow-green">
                    <span class="text-white font-black">M</span>
                </div>
                <span class="text-white font-black text-xl">Meeqat<span class="text-primary-400">.io</span></span>
            </div>

            <div class="card-premium p-8 md:p-10">

                {{-- Icon --}}
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary-500/20 to-primary-600/10 border border-primary-500/30 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>

                <h1 class="text-3xl font-black text-white mb-3">Verify Your Email</h1>
                <p class="text-dark-400 text-sm leading-relaxed mb-8">
                    We've sent a verification link to <strong class="text-white">{{ auth()->user()->email }}</strong>.
                    Please check your inbox and click the link to activate your account.
                </p>

                {{-- Success Message --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="alert-success mb-6">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm">A new verification link has been sent to your email.</p>
                    </div>
                @endif

                {{-- Resend Form --}}
                <form method="POST" action="{{ route('verification.send') }}" class="mb-6">
                    @csrf
                    <button
                        type="submit"
                        class="w-full py-3.5 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center gap-2 bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-glow-green hover:from-primary-400 hover:to-primary-500 hover:-translate-y-0.5"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Resend Verification Email
                    </button>
                </form>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-dark-500 hover:text-dark-300 text-sm transition-colors">
                        Logout
                    </button>
                </form>
            </div>

            {{-- Back to Home --}}
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-dark-500 hover:text-dark-300 text-sm transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Meeqat.io
                </a>
            </div>
        </div>
    </div>
</body>
</html>
</parameter>
<parameter=task_progress>
- [x] Audit project structure and identify all files
- [x] Review configuration files (tailwind.config.js, vite.config.js)
- [x] Audit CSS file
- [x] Audit layouts, partials, and components
- [x] Audit all view files
- [x] Audit JS files
- [x] Identify UI problems (duplication, inconsistency, etc.)
- [x] Create unified design system
- [x] Refactor typography
- [x] Refactor navbar
- [ ] Refactor hero section
- [ ] Standardize buttons
- [ ] Standardize cards
- [ ] Standardize forms
- [ ] Standardize tables
- [ ] Standardize icons
- [ ] Clean up backgrounds
- [ ] Improve footer
- [ ] Add animations
- [ ] Fix responsive issues
- [ ] Improve accessibility
- [ ] Optimize code
- [ ] Final validation
</parameter>
</write_to_file>