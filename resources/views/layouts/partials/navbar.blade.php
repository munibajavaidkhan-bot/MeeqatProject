{{-- resources/views/layouts/partials/navbar.blade.php --}}
<nav
    x-data="navbar()"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="scrolled
        ? 'bg-surface/90 backdrop-blur-md shadow-card border-b border-border'
        : 'bg-transparent'"
    aria-label="Main navigation"
>
    <div class="container-app">
        <div class="flex items-center justify-between h-16 lg:h-20">

            {{-- ── Logo ─────────────────────────────────── --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 group"
               aria-label="Meeqat.io — Home">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700
                            flex items-center justify-center
                            shadow-btn group-hover:shadow-glow-green
                            group-hover:scale-105 transition-all duration-200">
                    <span class="text-white font-bold font-heading text-sm" aria-hidden="true">M</span>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-heading font-bold font-heading text-lg leading-tight">
                        Meeqat<span class="text-primary-500">.io</span>
                    </span>
                    <span class="text-muted text-caption leading-tight mt-0.5">
                        Hajj & Umrah Companion
                    </span>
                </div>
            </a>

            {{-- ── Desktop Navigation ───────────────────── --}}
            <div class="hidden lg:flex items-center gap-1" role="navigation" aria-label="Primary navigation">

                <a href="{{ route('home') }}"
                   class="nav-link px-4 py-2 {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                    Home
                </a>

                <a href="{{ route('calculator.chaddar') }}"
                   class="nav-link px-4 py-2 {{ request()->routeIs('calculator.*') ? 'nav-link-active' : '' }}">
                    Calculator
                </a>

                <a href="{{ route('meeqat.finder') }}"
                   class="nav-link px-4 py-2 {{ request()->routeIs('meeqat.*') ? 'nav-link-active' : '' }}">
                    Meeqat Finder
                </a>

                {{-- Learn Dropdown --}}
                <div class="relative"
                     x-data="{ open: false }"
                     @mouseenter="open = true"
                     @mouseleave="open = false"
                     @keydown.escape="open = false">

                    <button
                        class="nav-link px-4 py-2 flex items-center gap-1.5"
                        :aria-expanded="open"
                        aria-haspopup="true"
                        id="learn-menu-btn"
                        aria-controls="learn-menu"
                    >
                        Learn
                        <svg class="w-4 h-4 transition-transform duration-200"
                             :class="open ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        id="learn-menu"
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-full left-0 mt-2 w-56 dropdown-menu"
                        role="menu"
                        aria-labelledby="learn-menu-btn"
                        style="display: none;"
                    >
                        {{-- Duas & Niyat --}}
                        <a href="{{ route('duas.index') }}"
                           class="dropdown-item"
                           role="menuitem">
                            <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-body-sm text-heading">Duas & Niyat</p>
                                <p class="text-caption text-muted">Islamic prayers collection</p>
                            </div>
                        </a>

                        {{-- Ihram Guide --}}
                        <a href="{{ route('ihram.index') }}"
                           class="dropdown-item"
                           role="menuitem">
                            <div class="w-8 h-8 rounded-lg bg-secondary-50 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                <svg class="w-4 h-4 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-body-sm text-heading">Ihram Guide</p>
                                <p class="text-caption text-muted">Rules & regulations</p>
                            </div>
                        </a>

                        {{-- Virtual Try-On --}}
                        <a href="{{ route('tryon.index') }}"
                           class="dropdown-item"
                           role="menuitem">
                            <div class="w-8 h-8 rounded-lg bg-accent-500/10 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                                <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-body-sm text-heading">Virtual Try-On</p>
                                <p class="text-caption text-muted">Try prayer caps online</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Right Side Auth ──────────────────────── --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    {{-- User dropdown --}}
                    <div class="relative"
                         x-data="{ open: false }"
                         @click.outside="open = false"
                         @keydown.escape="open = false">

                        <button
                            @click="open = !open"
                            class="flex items-center gap-2.5 px-3 py-2 rounded-btn
                                   bg-surface border border-border
                                   hover:border-dark-300 hover:bg-dark-50
                                   transition-all duration-200
                                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                            :aria-expanded="open"
                            aria-haspopup="true"
                        >
                            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-primary-500 to-primary-700
                                        flex items-center justify-center text-white text-caption font-bold"
                                 aria-hidden="true">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-heading text-body-sm font-medium">
                                {{ Str::limit(auth()->user()->name, 12) }}
                            </span>
                            <svg class="w-4 h-4 text-muted transition-transform duration-200"
                                 :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                                 aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-full mt-2 w-56 dropdown-menu"
                            style="display: none;"
                        >
                            {{-- User Info Header --}}
                            <div class="px-4 py-3 border-b border-border">
                                <p class="text-body-sm font-semibold text-heading truncate">{{ auth()->user()->name }}</p>
                                <p class="text-caption text-muted truncate">{{ auth()->user()->email }}</p>
                                <span class="badge-green mt-1.5">{{ auth()->user()->role_label ?? 'User' }}</span>
                            </div>

                            {{-- Menu items --}}
                            <div class="py-1">
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('user.bookmarks') }}" class="dropdown-item">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                    </svg>
                                    My Bookmarks
                                </a>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>

                                @if(auth()->user()->isAdminOrEditor())
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item text-primary-600">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endif

                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item w-full text-red-600 hover:bg-red-50 hover:text-red-700">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary btn-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary btn-sm">
                        Sign Up
                    </a>
                @endauth
            </div>

            {{-- ── Mobile Menu Button ───────────────────── --}}
            <button
                @click="toggleMobile()"
                class="lg:hidden w-10 h-10 rounded-btn
                       bg-surface border border-border
                       flex items-center justify-center
                       text-muted hover:text-heading hover:bg-dark-50
                       transition-all duration-200
                       focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                :aria-expanded="mobileOpen"
                aria-label="Toggle mobile navigation"
            >
                <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Mobile Menu ──────────────────────────────────── --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-3"
        class="lg:hidden bg-surface border-b border-border shadow-elevated"
        style="display: none;"
        id="mobile-nav"
        role="navigation"
        aria-label="Mobile navigation"
    >
        <div class="container-app py-4 space-y-1">

            @php
                $mobileLinks = [
                    ['route' => 'home',               'label' => 'Home',                'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'calculator.chaddar', 'label' => 'Chaddar Calculator',  'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                    ['route' => 'meeqat.finder',      'label' => 'Meeqat Finder',       'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['route' => 'duas.index',          'label' => 'Duas & Niyat',        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['route' => 'ihram.index',         'label' => 'Ihram Guide',         'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['route' => 'tryon.index',         'label' => 'Virtual Try-On',      'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                ];
            @endphp

            @foreach($mobileLinks as $link)
                <a href="{{ route($link['route']) }}"
                   @click="closeMobile()"
                   class="flex items-center gap-3 px-4 py-3 rounded-btn
                          text-body-sm font-medium
                          transition-colors duration-150
                          {{ request()->routeIs($link['route'])
                             ? 'bg-primary-50 text-primary-600'
                             : 'text-heading hover:bg-dark-50' }}"
                   {{ request()->routeIs($link['route']) ? 'aria-current=page' : '' }}>
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                    </svg>
                    {{ $link['label'] }}
                </a>
            @endforeach

            {{-- Auth CTA --}}
            <div class="border-t border-border pt-3 mt-2 flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="btn-primary flex-1 text-center"
                       @click="closeMobile()">
                        My Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn-secondary flex-1 text-center"
                       @click="closeMobile()">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn-primary flex-1 text-center"
                       @click="closeMobile()">
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>