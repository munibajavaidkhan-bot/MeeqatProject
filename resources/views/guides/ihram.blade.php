@extends('layouts.app')
@section('title', 'Ihram Rules Visual Guide')

@section('content')

{{-- Page Header --}}
<div class="relative pt-32 pb-16 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 left-1/4 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-1/3 w-96 h-96 bg-secondary-500/4 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-primary-500/3 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 text-muted text-sm mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-primary-600 font-medium">Ihram Guide</span>
        </div>

        <div class="flex items-center gap-5 mb-6">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-700 flex items-center justify-center shadow-lg flex-shrink-0">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-black text-heading">Ihram Rules <span class="text-primary-600">Visual Guide</span></h1>
                <p class="text-muted mt-1.5">Complete guide with rules for men, women, prohibited & recommended acts</p>
            </div>
        </div>

        {{-- Stats Bar with SVG Icons --}}
        @php
            $generalSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>';
            $menSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>';
            $womenSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v6m-3-3h6M16 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>';
            $prohibitedSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            $recommendedSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>';

            $allFilterSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>';

            $statCategories = [
                ['key' => 'general',     'color' => 'text-primary-400', 'bg' => 'bg-primary-500/10',      'icon' => $generalSvg],
                ['key' => 'men',          'color' => 'text-blue-400',    'bg' => 'bg-blue-500/10',         'icon' => $menSvg],
                ['key' => 'women',        'color' => 'text-pink-400',    'bg' => 'bg-pink-500/10',         'icon' => $womenSvg],
                ['key' => 'prohibited',   'color' => 'text-red-400',     'bg' => 'bg-red-500/10',          'icon' => $prohibitedSvg],
                ['key' => 'recommended',  'color' => 'text-gold-400',    'bg' => 'bg-gold-500/10',         'icon' => $recommendedSvg],
            ];
        @endphp
        <div class="flex flex-wrap gap-3">
            @foreach($statCategories as $stat)
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $stat['bg'] }} {{ $stat['color'] }} border border-current/20">
                    {!! $stat['icon'] !!}
                    {{ ucfirst($stat['key']) }}:
                    <strong>{{ $counts[$stat['key']] ?? 0 }}</strong>
                </span>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

    {{-- Filter Tabs with SVG Icons --}}
    @php
    $filters = [
        ['all',         $allFilterSvg, 'All Rules'],
        ['general',     $generalSvg, 'General'],
        ['men',         $menSvg, 'Men'],
        ['women',       $womenSvg, 'Women'],
        ['prohibited',  $prohibitedSvg, 'Prohibited'],
        ['recommended', $recommendedSvg, 'Recommended'],
    ];
    @endphp
    <div class="flex flex-wrap gap-2 mb-10 p-1.5 bg-surface border border-border rounded-2xl w-fit">
        @foreach($filters as $filter)
            <a
                href="{{ route('ihram.index', ['filter' => $filter[0]]) }}"
                class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2
                {{ $activeFilter === $filter[0]
                    ? 'bg-primary-500 text-white shadow-glow-green'
                    : 'text-muted hover:text-heading hover:bg-dark-50' }}"
            >
                {!! $filter[1] !!} {{ $filter[2] }}
                @if($filter[0] !== 'all' && isset($counts[$filter[0]]))
                    <span class="text-xs opacity-70">({{ $counts[$filter[0]] }})</span>
                @endif
            </a>
        @endforeach
    </div>

    {{-- Category Header SVG Icons Map --}}
    @php
        $categorySvgIcons = [
            'men'         => $menSvg,
            'women'       => $womenSvg,
            'general'     => $generalSvg,
            'prohibited'  => $prohibitedSvg,
            'recommended' => $recommendedSvg,
        ];
        $categoryLabels = [
            'men' => 'Men Rules', 'women' => 'Women Rules', 'general' => 'General Rules',
            'prohibited' => 'Prohibited Acts', 'recommended' => 'Recommended Acts'
        ];
    @endphp

    {{-- Guides Display --}}
    @if($activeFilter === 'all')
        {{-- Show grouped by category --}}
        @foreach($allGuides as $categoryName => $categoryGuides)
            <div class="mb-14 animate-fade-in">
                {{-- Category Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-black text-heading flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-primary-500 rounded-full"></span>
                        <span class="flex items-center gap-2.5">
                            @if(isset($categorySvgIcons[$categoryName]))
                                {!! str_replace('w-4 h-4', 'w-5 h-5 text-primary-500', $categorySvgIcons[$categoryName]) !!}
                            @endif
                            {{ $categoryLabels[$categoryName] ?? $categoryName }}
                        </span>
                    </h2>
                    <a href="{{ route('ihram.index', ['filter' => $categoryName]) }}"
                       class="text-primary-600 text-sm hover:underline flex items-center gap-1">
                        View all {{ $categoryGuides->count() }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>

                {{-- Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoryGuides as $guide)
                        <div class="group relative card overflow-hidden border bg-gradient-to-br {{ $guide->category_color }} transition-all duration-500 hover:-translate-y-2 hover:shadow-elevated animate-slide-up"
                             style="animation-delay: {{ $loop->index * 0.08 }}s">

                            {{-- Decorative top gradient bar --}}
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-current/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            {{-- Hover glow effect --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-current/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                            <div class="relative p-6 z-10">
                                <div class="flex items-start justify-between mb-4">
                                    {{-- SVG Icon with animated container --}}
                                    <div class="w-12 h-12 rounded-xl bg-surface/80 backdrop-blur-sm border border-border/50 flex items-center justify-center
                                                group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg transition-all duration-500">
                                        {!! $guide->svg_icon !!}
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 badge text-xs bg-surface/80 backdrop-blur-sm border border-border/50 text-muted px-3 py-1">
                                        {!! $guide->category_svg_icon !!}
                                        @php $parts = explode(' ', $guide->category_label, 2); @endphp
                                        {{ $parts[1] ?? $parts[0] }}
                                    </span>
                                </div>

                                <h3 class="text-heading font-bold text-lg mb-3 group-hover:text-current transition-colors duration-300">{{ $guide->title_en }}</h3>
                                <p class="text-muted text-sm leading-relaxed line-clamp-3 mb-4">{{ $guide->content_en }}</p>

                                @if($guide->title_ur)
                                    <p class="urdu text-muted text-sm leading-loose line-clamp-2 mb-4 border-t border-border/50 pt-3">{{ $guide->title_ur }}</p>
                                @endif

                                <a href="{{ route('ihram.show', $guide->id) }}"
                                   class="inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-primary-500 group/link transition-all duration-300">
                                    <span class="relative">
                                        Read Full Rule
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-500 group-hover/link:w-full transition-all duration-300"></span>
                                    </span>
                                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    @else
        {{-- Filtered View --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($filteredGuides as $guide)
                <div class="group relative card overflow-hidden border bg-gradient-to-br {{ $guide->category_color }} transition-all duration-500 hover:-translate-y-2 hover:shadow-elevated animate-slide-up"
                     style="animation-delay: {{ $loop->index * 0.08 }}s">

                    {{-- Decorative top gradient bar --}}
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-current/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-current/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="relative p-6 z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-surface/80 backdrop-blur-sm border border-border/50 flex items-center justify-center
                                        group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg transition-all duration-500">
                                {!! $guide->svg_icon !!}
                            </div>
                            <span class="inline-flex items-center gap-1.5 badge text-xs bg-surface/80 backdrop-blur-sm border border-border/50 text-muted px-3 py-1">
                                {!! $guide->category_svg_icon !!}
                                @php $parts = explode(' ', $guide->category_label, 2); @endphp
                                {{ $parts[1] ?? $parts[0] }}
                            </span>
                        </div>

                        <h3 class="text-heading font-bold text-lg mb-3 group-hover:text-current transition-colors duration-300">{{ $guide->title_en }}</h3>
                        <p class="text-muted text-sm leading-relaxed line-clamp-3 mb-4">{{ $guide->content_en }}</p>

                        @if($guide->title_ur)
                            <p class="urdu text-muted text-sm leading-loose mb-4 border-t border-border/50 pt-3">{{ $guide->title_ur }}</p>
                        @endif

                        <a href="{{ route('ihram.show', $guide->id) }}"
                           class="inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-primary-500 group/link transition-all duration-300">
                            <span class="relative">
                                Read Full Rule
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary-500 group-hover/link:w-full transition-all duration-300"></span>
                            </span>
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Bottom CTA --}}
    <div class="mt-16 relative rounded-3xl overflow-hidden animate-fade-in">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-800 via-primary-700 to-primary-600 rounded-3xl"></div>
        <div class="absolute inset-0 opacity-10" aria-hidden="true"
             style="background-image: linear-gradient(rgba(255,255,255,0.6) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.6) 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-secondary-500/20 rounded-full blur-3xl" aria-hidden="true"></div>
        <div class="relative p-10 flex flex-col md:flex-row items-center justify-between gap-6 z-10">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0 border border-white/10">
                    <svg class="w-7 h-7 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl md:text-3xl font-black text-white mb-1">Ready for Your Ihram?</h3>
                    <p class="text-primary-100/80 max-w-md text-sm">Read all rules carefully. Check Meeqat distance and prepare your duas before entering the sacred state.</p>
                </div>
            </div>
            <div class="flex gap-3 flex-shrink-0">
                <a href="{{ route('meeqat.finder') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold text-white border-2 border-white/30 hover:bg-white/10 hover:border-white/50 transition-all duration-200 backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                    </svg>
                    Meeqat Finder
                </a>
                <a href="{{ route('niyat.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold bg-primary-500 text-white hover:bg-primary-600 transition-all duration-200 shadow-glow-green">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-6m0 0l-3-3m3 3l3-3M12 9V3M6.512 11.825C5.058 7.72 6.392 4.5 9.528 4.5c1.907 0 3.493 1.13 4.472 2.755M3 21h18"/>
                    </svg>
                    View Niyat
                </a>
            </div>
        </div>
    </div>
</div>

@endsection