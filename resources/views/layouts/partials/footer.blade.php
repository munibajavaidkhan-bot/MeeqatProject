{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="relative bg-footer border-t border-dark-800/60 mt-20 overflow-hidden"
        aria-label="Site footer">

    {{-- Background Glow --}}
    <div class="absolute inset-0 opacity-20" aria-hidden="true">
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-primary-500 rounded-full blur-3xl"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-secondary-500 rounded-full blur-3xl" style="opacity: 0.15;"></div>
    </div>

    {{-- ── Main Footer ───────────────────────────────────── --}}
    <div class="container-app py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Brand Column --}}
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 mb-5 group w-fit"
                   aria-label="Meeqat.io — Home">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700
                                flex items-center justify-center
                                shadow-btn group-hover:shadow-glow-green
                                group-hover:scale-105 transition-all duration-200">
                        <span class="text-white font-bold font-heading" aria-hidden="true">M</span>
                    </div>
                    <span class="text-white font-bold font-heading text-xl">
                        Meeqat<span class="text-primary-400">.io</span>
                    </span>
                </a>

                <p class="text-dark-400 text-body-sm leading-relaxed mb-6 max-w-xs">
                    Smart digital tools for Hajj & Umrah pilgrims. Making your spiritual journey easier and more informed.
                </p>

                {{-- Arabic Dua --}}
                <div class="bg-dark-800/60 border border-dark-700/50 p-4 rounded-xl inline-block"
                     aria-label="Quranic dua: Rabbana Taqabbal Minna">
                    <p class="arabic text-gold-400 text-xl leading-loose mb-1">رَبَّنَا تَقَبَّلْ مِنَّا</p>
                    <p class="text-dark-500 text-caption text-center font-medium">Rabbana Taqabbal Minna</p>
                </div>
            </div>

            {{-- Quick Tools --}}
            <div>
                <h4 class="text-white font-semibold font-heading text-h5 mb-5 flex items-center gap-2">
                    <span class="w-1 h-4 bg-primary-500 rounded-full" aria-hidden="true"></span>
                    Quick Tools
                </h4>
                <ul class="space-y-3" role="list">
                    @php
                        $quickLinks = [
                            [
                                'label' => 'Chaddar Calculator',
                                'route' => 'calculator.chaddar',
                                'icon'  => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                            ],
                            [
                                'label' => 'Meeqat Finder',
                                'route' => 'meeqat.finder',
                                'icon'  => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z',
                            ],
                            [
                                'label' => 'Duas & Niyat',
                                'route' => 'duas.index',
                                'icon'  => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                            ],
                            [
                                'label' => 'Ihram Guide',
                                'route' => 'ihram.index',
                                'icon'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                            ],
                            [
                                'label' => 'Virtual Try-On',
                                'route' => 'tryon.index',
                                'icon'  => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            ],
                        ];
                    @endphp

                    @foreach($quickLinks as $link)
                        <li>
                            <a href="{{ route($link['route']) }}"
                               class="flex items-center gap-2.5 text-dark-400 text-body-sm
                                      hover:text-primary-400 transition-colors duration-200 group">
                                <svg class="w-4 h-4 flex-shrink-0 text-dark-600 group-hover:text-primary-400 transition-colors duration-200"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                                </svg>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Information --}}
            <div>
                <h4 class="text-white font-semibold font-heading text-h5 mb-5 flex items-center gap-2">
                    <span class="w-1 h-4 bg-secondary-500 rounded-full" aria-hidden="true"></span>
                    Information
                </h4>
                <ul class="space-y-3 mb-8" role="list">
                    @php
                        $infoLinks = [
                            ['label' => 'About Us',       'route' => 'about',        'anchor' => ''],
                            ['label' => 'Contact',        'route' => 'contact',      'anchor' => ''],
                            ['label' => 'Privacy Policy', 'route' => 'about',        'anchor' => '#privacy-policy'],
                            ['label' => 'Terms of Use',   'route' => 'about',        'anchor' => '#terms-of-use'],
                        ];
                    @endphp

                    @foreach($infoLinks as $link)
                        <li>
                            <a href="{{ $link['anchor'] ? route($link['route']) . $link['anchor'] : route($link['route']) }}"
                               class="text-dark-400 text-body-sm hover:text-secondary-400 transition-colors duration-200">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- Social Links --}}
                <div>
                    <h5 class="text-dark-500 text-caption font-semibold uppercase tracking-wider mb-3">
                        Follow Us
                    </h5>
                    <div class="flex gap-2" role="list" aria-label="Social media links">
                        {{-- Facebook --}}
                        <a href="https://facebook.com/meeqatio" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-xl bg-dark-800 border border-dark-700/50
                                  flex items-center justify-center
                                  text-dark-400 hover:text-primary-400
                                  hover:bg-primary-500/10 hover:border-primary-500/30
                                  transition-all duration-200
                                  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                           aria-label="Facebook"
                           rel="noopener noreferrer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a href="https://instagram.com/meeqat.io" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-xl bg-dark-800 border border-dark-700/50
                                  flex items-center justify-center
                                  text-dark-400 hover:text-primary-400
                                  hover:bg-primary-500/10 hover:border-primary-500/30
                                  transition-all duration-200
                                  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                           aria-label="Instagram"
                           rel="noopener noreferrer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>

                        {{-- YouTube --}}
                        <a href="https://youtube.com/@meeqatio" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-xl bg-dark-800 border border-dark-700/50
                                  flex items-center justify-center
                                  text-dark-400 hover:text-primary-400
                                  hover:bg-primary-500/10 hover:border-primary-500/30
                                  transition-all duration-200
                                  focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                           aria-label="YouTube"
                           rel="noopener noreferrer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Bottom Bar ─────────────────────────────────────── --}}
    <div class="border-t border-dark-800/50">
        <div class="container-app py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-dark-500 text-body-sm">
                © {{ date('Y') }}
                <a href="{{ route('home') }}" class="text-primary-400 hover:text-primary-300 transition-colors duration-200">
                    Meeqat.io
                </a>
                — All rights reserved.
            </p>
            <p class="text-dark-600 text-caption">
                Made with care for Hajj & Umrah pilgrims
            </p>
        </div>
    </div>
</footer>