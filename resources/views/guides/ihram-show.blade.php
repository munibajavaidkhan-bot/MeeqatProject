@extends('layouts.app')
@section('title', $guide->title_en)

@section('content')

<div class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 right-1/4 w-80 h-80 bg-primary-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-40 left-1/3 w-64 h-64 bg-secondary-500/4 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="{{ route('ihram.index') }}" class="inline-flex items-center gap-2 text-muted hover:text-primary-600 text-sm mb-8 transition-all duration-200 group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Ihram Guide
        </a>

        {{-- Main Card --}}
        <div class="card overflow-hidden mb-8 animate-slide-up">
            {{-- Gradient top bar --}}
            <div class="h-1.5 bg-gradient-to-r from-gold-500 via-primary-500 to-gold-500"></div>

            <div class="p-8 md:p-12">
                {{-- Category Badge with SVG --}}
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center gap-2 badge {{ $guide->category_color }} border text-sm px-4 py-1.5">
                        {!! $guide->category_svg_icon !!}
                        @php $parts = explode(' ', $guide->category_label, 2); @endphp
                        {{ $parts[1] ?? $parts[0] }}
                    </span>
                </div>

                {{-- SVG Icon + Title --}}
                <div class="flex items-start gap-6 mb-8">
                    <div class="w-20 h-20 rounded-2xl {{ $guide->category_color }} flex items-center justify-center flex-shrink-0 animate-float shadow-lg">
                        {!! $guide->svg_icon !!}
                    </div>
                    <div class="pt-2">
                        <h1 class="text-3xl md:text-4xl font-black text-heading mb-2">{{ $guide->title_en }}</h1>
                        @if($guide->title_ur)
                            <p class="urdu text-secondary-600 text-xl">{{ $guide->title_ur }}</p>
                        @endif
                    </div>
                </div>

                {{-- English Content --}}
                <div class="card p-6 mb-6 border-l-4 border-l-primary-500">
                    <h3 class="text-primary-600 font-bold mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        English
                    </h3>
                    <p class="text-body leading-relaxed text-lg">{{ $guide->content_en }}</p>
                </div>

                {{-- Urdu Content --}}
                @if($guide->content_ur)
                    <div class="card p-6 border-r-4 border-r-secondary-500">
                        <h3 class="text-secondary-600 font-bold mb-3 flex items-center justify-end gap-2">
                            اردو
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                            </svg>
                        </h3>
                        <p class="urdu text-body text-xl leading-loose text-right">{{ $guide->content_ur }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Related Guides --}}
        @if($related->count() > 0)
            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <h3 class="text-heading font-bold text-xl mb-5 flex items-center gap-2">
                    <span class="w-1 h-5 bg-primary-500 rounded-full"></span>
                    More {{ ucfirst($guide->category) }} Rules
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($related as $rel)
                        <a href="{{ route('ihram.show', $rel->id) }}"
                           class="card p-5 hover:border-primary-200 hover:-translate-y-1.5 transition-all duration-300 group relative overflow-hidden animate-slide-up"
                           style="animation-delay: {{ $loop->index * 0.1 }}s">
                            <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary-500/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="w-12 h-12 rounded-xl bg-surface border border-border/50 flex items-center justify-center mb-3 group-hover:scale-110 group-hover:rotate-3 transition-all duration-400">
                                {!! $rel->svg_icon !!}
                            </div>
                            <h4 class="text-heading font-semibold mb-2 group-hover:text-primary-500 transition-colors">{{ $rel->title_en }}</h4>
                            <p class="text-muted text-xs line-clamp-2">{{ $rel->content_en }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-3 mt-8 animate-fade-in" style="animation-delay: 0.3s">
            <a href="{{ route('ihram.index') }}" class="btn-outline text-sm py-2.5 px-5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                All Rules
            </a>
            <a href="{{ route('ihram.index', ['filter' => $guide->category]) }}" class="btn-outline text-sm py-2.5 px-5">
                {!! $guide->category_svg_icon !!}
                @php $parts = explode(' ', $guide->category_label, 2); @endphp
                {{ $parts[1] ?? $parts[0] }} Rules
            </a>
            <a href="{{ route('niyat.index') }}" class="btn-primary text-sm py-2.5 px-5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-6m0 0l-3-3m3 3l3-3M12 9V3M6.512 11.825C5.058 7.72 6.392 4.5 9.528 4.5c1.907 0 3.493 1.13 4.472 2.755M3 21h18"/>
                </svg>
                View Niyat
            </a>
        </div>

    </div>
</div>

@endsection