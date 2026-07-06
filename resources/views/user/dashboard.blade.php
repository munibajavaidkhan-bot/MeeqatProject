@extends('layouts.app')
@section('title', 'My Dashboard')

@section('content')
<div class="pt-32 pb-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-black text-white mb-8">
        Welcome back, <span class="text-primary-400">{{ auth()->user()->name }}</span>!
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Recent Calculations --}}
        <div class="card-premium p-6">
            <h3 class="text-white font-bold mb-4 flex items-center gap-2">📏 Recent Calculations</h3>
            @forelse($recentCalculations as $calc)
                <a href="{{ route('calculator.chaddar.result', $calc->id) }}"
                   class="flex items-center justify-between p-3 rounded-xl hover:bg-dark-800 transition-colors mb-2">
                    <div>
                        <p class="text-white text-sm font-medium">{{ $calc->height_cm }}cm — {{ ucfirst($calc->style) }}</p>
                        <p class="text-dark-500 text-xs">{{ $calc->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="badge-green text-xs">{{ $calc->calculated_meters }}m</span>
                </a>
            @empty
                <p class="text-dark-500 text-sm">No calculations yet.</p>
                <a href="{{ route('calculator.chaddar') }}" class="btn-primary text-sm mt-3">Calculate Now</a>
            @endforelse
        </div>

        {{-- Recent Meeqat Searches --}}
        <div class="card-premium p-6">
            <h3 class="text-white font-bold mb-4 flex items-center gap-2">📍 Recent Meeqat Searches</h3>
            @forelse($recentSearches as $search)
                <a href="{{ route('meeqat.result', $search->id) }}"
                   class="flex items-center justify-between p-3 rounded-xl hover:bg-dark-800 transition-colors mb-2">
                    <div>
                        <p class="text-white text-sm font-medium">{{ $search->nearestMeeqat?->name_en ?? 'N/A' }}</p>
                        <p class="text-dark-500 text-xs">{{ $search->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="badge-blue text-xs">{{ number_format($search->nearest_distance_km, 1) }} km</span>
                </a>
            @empty
                <p class="text-dark-500 text-sm">No searches yet.</p>
                <a href="{{ route('meeqat.finder') }}" class="btn-primary text-sm mt-3">Find Meeqat</a>
            @endforelse
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
        @foreach([
            ['📏', 'Calculator',    'calculator.chaddar'],
            ['📍', 'Meeqat Finder', 'meeqat.finder'],
            ['🤲', 'Duas',          'duas.index'],
            ['📖', 'Ihram Guide',   'ihram.index'],
        ] as $link)
            <a href="{{ route($link[2]) }}"
               class="card p-4 text-center hover:-translate-y-1 transition-transform">
                <div class="text-3xl mb-2">{{ $link[0] }}</div>
                <p class="text-dark-300 text-sm font-medium">{{ $link[1] }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection