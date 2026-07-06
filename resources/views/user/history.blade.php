@extends('layouts.app')
@section('title', 'My History')

@section('content')
<div class="pt-32 pb-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-black text-white mb-8">My <span class="text-primary-400">History</span></h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Chaddar History --}}
        <div>
            <h2 class="text-xl font-bold text-white mb-4">📏 Chaddar Calculations</h2>
            @forelse($calculations as $calc)
                <a href="{{ route('calculator.chaddar.result', $calc->id) }}"
                   class="card p-4 mb-3 flex justify-between items-center hover:border-dark-700 transition-colors block">
                    <div>
                        <p class="text-white font-medium">{{ $calc->height_cm }} cm — {{ ucfirst($calc->style) }}</p>
                        <p class="text-dark-500 text-xs">{{ $calc->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-primary-400 font-bold">{{ $calc->calculated_meters }}m</span>
                        <p class="text-dark-600 text-xs">{{ $calc->size_label }}</p>
                    </div>
                </a>
            @empty
                <p class="text-dark-500">No calculations found.</p>
            @endforelse
            <div class="mt-3">{{ $calculations->links() }}</div>
        </div>

        {{-- Meeqat History --}}
        <div>
            <h2 class="text-xl font-bold text-white mb-4">📍 Meeqat Searches</h2>
            @forelse($searches as $search)
                <a href="{{ route('meeqat.result', $search->id) }}"
                   class="card p-4 mb-3 flex justify-between items-center hover:border-dark-700 transition-colors block">
                    <div>
                        <p class="text-white font-medium">{{ $search->nearestMeeqat?->name_en ?? 'N/A' }}</p>
                        <p class="text-dark-500 text-xs">{{ $search->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="badge-green text-xs">{{ number_format($search->nearest_distance_km, 1) }} km</span>
                </a>
            @empty
                <p class="text-dark-500">No searches found.</p>
            @endforelse
            <div class="mt-3">{{ $searches->links() }}</div>
        </div>
    </div>
</div>
@endsection