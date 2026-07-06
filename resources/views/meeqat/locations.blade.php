@extends('layouts.app')
@section('title', 'All Meeqat Locations')

@section('content')

<div class="relative pt-32 pb-20">
    {{-- Subtle background glow --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 left-1/4 w-80 h-80 bg-primary-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-sm font-medium mb-4">
                📍 5 Mawaqit-e-Ihram
            </div>
            <h1 class="section-title">All <span class="text-primary-600">Meeqat Locations</span></h1>
            <p class="section-subtitle max-w-xl mx-auto">
                The five designated stations where pilgrims enter the state of Ihram for Hajj or Umrah
            </p>
        </div>

        {{-- Meeqat Cards --}}
        <div class="space-y-6">
            @foreach($locations as $index => $loc)
                <div class="card overflow-hidden animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="grid grid-cols-1 md:grid-cols-4">

                        {{-- Number --}}
                        <div class="md:col-span-1 p-8 flex flex-col items-center justify-center text-center border-b md:border-b-0 md:border-r border-border"
                             style="background: linear-gradient(135deg, {{ $loc->color }}12, transparent);">
                            <div class="text-5xl mb-3">{{ $loc->icon }}</div>
                            <div class="text-5xl font-black" style="color: {{ $loc->color }}">{{ $index + 1 }}</div>
                            <div class="text-muted text-xs uppercase tracking-widest mt-1">Meeqat</div>
                        </div>

                        {{-- Details --}}
                        <div class="md:col-span-3 p-8">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-5">
                                <div>
                                    <h2 class="text-2xl font-black text-heading mb-1">{{ $loc->name_en }}</h2>
                                    <p class="arabic text-xl mb-1" style="color: {{ $loc->color }}">{{ $loc->name_ar }}</p>
                                    @if($loc->name_ur)
                                        <p class="urdu text-muted">{{ $loc->name_ur }}</p>
                                    @endif
                                </div>
                                <div class="flex gap-2 flex-shrink-0">
                                    <a href="{{ $loc->google_maps_url }}" target="_blank" class="btn-outline text-xs py-2 px-3">
                                        📍 Maps
                                    </a>
                                    <a href="{{ route('meeqat.finder') }}" class="btn-primary text-xs py-2 px-3">
                                        Distance Check
                                    </a>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-muted text-xs uppercase tracking-wider mb-2">Description</p>
                                    <p class="text-body text-sm leading-relaxed">{{ $loc->description }}</p>
                                    @if($loc->description_ur)
                                        <p class="urdu text-muted text-sm leading-loose mt-3">{{ $loc->description_ur }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-muted text-xs uppercase tracking-wider mb-2">For Pilgrims From</p>
                                    <p class="text-body text-sm leading-relaxed mb-4">{{ $loc->for_pilgrims_from }}</p>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="p-3 rounded-xl bg-surface border border-border">
                                            <p class="text-muted text-xs">Latitude</p>
                                            <p class="text-heading font-mono font-bold">{{ $loc->latitude }}°</p>
                                        </div>
                                        <div class="p-3 rounded-xl bg-surface border border-border">
                                            <p class="text-muted text-xs">Longitude</p>
                                            <p class="text-heading font-mono font-bold">{{ $loc->longitude }}°</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a href="{{ route('meeqat.finder') }}" class="btn-primary text-base px-8 py-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                Find My Nearest Meeqat
            </a>
        </div>
    </div>
</div>

@endsection