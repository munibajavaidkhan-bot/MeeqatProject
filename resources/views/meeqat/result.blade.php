@extends('layouts.app')

@section('title', 'Meeqat Result — ' . ($result['nearest_meeqat']->name_en ?? ''))

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        #result-map {
            height: 350px;
            border-radius: 1rem;
        }
        .leaflet-popup-content-wrapper {
            background: #1e293b;
            color: #e2e8f0;
            border: 1px solid #334155;
            border-radius: 12px;
        }
        .leaflet-popup-tip { background: #1e293b; }
        .distance-bar {
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
@endpush

@section('content')

<div class="relative pt-32 pb-20 min-h-screen">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 left-1/4 w-80 h-80 bg-primary-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-1/4 w-80 h-80 bg-blue-500/3 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Back --}}
        <a href="{{ route('meeqat.finder') }}" class="inline-flex items-center gap-2 text-muted hover:text-primary-600 text-sm mb-8 transition-colors group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Meeqat Finder
        </a>

        {{-- Header --}}
        <div class="text-center mb-8 animate-slide-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 text-primary-700 border border-primary-200 text-sm font-medium mb-4">
                ✅ Nearest Meeqat Found!
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-heading">
                Your <span class="text-primary-600">Nearest Meeqat</span> Found!
            </h1>
        </div>

        {{-- Ihram Warning --}}
        @if($result['ihram_warning'])
            @php $warning = $result['ihram_warning']; @endphp
            <div class="mb-6 animate-slide-up
                {{ $warning['color'] === 'red'  ? 'alert-error'   : '' }}
                {{ $warning['color'] === 'gold' ? 'alert-warning' : '' }}
                {{ $warning['color'] === 'blue' ? 'alert-info'    : '' }}
            ">
                <span class="text-2xl flex-shrink-0">
                    {{ $warning['color'] === 'red' ? '⚠️' : ($warning['color'] === 'gold' ? '⚡' : 'ℹ️') }}
                </span>
                <p class="font-semibold">{{ $warning['message'] }}</p>
            </div>
        @endif

        {{-- MAIN RESULT CARD --}}
        <div class="card overflow-hidden mb-6 animate-slide-up">
            <div class="h-1 w-full bg-gradient-to-r from-primary-500 via-blue-500 to-primary-500"></div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Left: Nearest Meeqat --}}
                    <div class="text-center md:text-left">
                        <p class="text-muted text-sm font-semibold uppercase tracking-wider mb-3">Nearest Meeqat</p>

                        <div class="flex items-center gap-4 mb-4 justify-center md:justify-start">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl border-2 {{ $result['nearest_meeqat']->bg_color_class }}">
                                {{ $result['nearest_meeqat']->icon }}
                            </div>
                            <div>
                                <h2 class="text-heading font-black text-xl">
                                    {{ explode('(', $result['nearest_meeqat']->name_en)[0] }}
                                </h2>
                                <p class="arabic text-secondary-600 text-lg">
                                    {{ $result['nearest_meeqat']->name_ar }}
                                </p>
                                @if($result['nearest_meeqat']->name_ur)
                                    <p class="urdu text-muted text-sm">
                                        {{ $result['nearest_meeqat']->name_ur }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="card p-4 inline-block text-sm text-muted text-left">
                            <p class="text-muted text-xs uppercase tracking-wider mb-1">For Pilgrims From</p>
                            <p class="text-heading">{{ $result['nearest_meeqat']->for_pilgrims_from }}</p>
                        </div>
                    </div>

                    {{-- Right: Distance Stats --}}
                    <div class="space-y-4">
                        {{-- Big Distance --}}
                        <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-primary-500/10 to-primary-600/5 border border-primary-500/20">
                            <p class="text-primary-500 text-xs uppercase tracking-wider mb-1">Distance</p>
                            <div class="flex items-end justify-center gap-2">
                                <span class="text-5xl font-black text-heading" id="distanceKm">0</span>
                                <span class="text-2xl text-primary-600 font-bold mb-1">km</span>
                            </div>
                            <p class="text-muted text-sm mt-1">
                                ≈ <span id="distanceMi">0</span> miles
                            </p>
                        </div>

                        {{-- Travel Time --}}
                        @if(isset($result['nearest']['travel_info']))
                            <div class="grid grid-cols-3 gap-2">
                                @foreach([
                                    ['✈️', 'By Air', $result['nearest']['travel_info']['by_air']],
                                    ['🚗', 'By Car', $result['nearest']['travel_info']['by_car']],
                                    ['🚌', 'By Bus', $result['nearest']['travel_info']['by_bus']],
                                ] as $travel)
                                    <div class="text-center p-3 rounded-xl bg-surface border border-border">
                                        <div class="text-xl mb-1">{{ $travel[0] }}</div>
                                        <p class="text-heading font-bold text-sm">{{ $travel[2] }}</p>
                                        <p class="text-muted text-xs">{{ $travel[1] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Direction --}}
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-surface border border-border">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-bold">
                                {{ $result['nearest']['direction'] ?? 'N' }}
                            </div>
                            <div>
                                <p class="text-muted text-xs">Direction</p>
                                <p class="text-heading font-semibold text-sm">
                                    {{ $result['nearest']['direction'] ?? '' }} from your location
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALL DISTANCES TABLE --}}
        <div class="card overflow-hidden mb-6 animate-slide-up" style="animation-delay: 0.1s;">
            <div class="p-5 border-b border-border">
                <h3 class="text-heading font-bold flex items-center gap-2">
                    📊 Distance from All Meeqat
                </h3>
            </div>
            <div class="p-5 space-y-3">
                @foreach($result['all_distances'] as $index => $distanceData)
                    @php
                        $isNearest = $index === 0;
                        $maxDist   = $result['all_distances']->last()['distance_km'];
                        $percent   = $maxDist > 0 ? ($distanceData['distance_km'] / $maxDist) * 100 : 0;
                    @endphp
                    <div class="p-4 rounded-xl {{ $isNearest ? 'bg-primary-50 border border-primary-200' : 'bg-surface border border-border' }}">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                @if($isNearest)
                                    <span class="badge-green text-xs">Nearest</span>
                                @else
                                    <span class="text-muted text-sm">#{{ $index + 1 }}</span>
                                @endif
                                <div>
                                    <p class="{{ $isNearest ? 'text-heading' : 'text-heading' }} font-semibold text-sm">
                                        {{ $distanceData['meeqat']->icon }} {{ explode('(', $distanceData['meeqat']->name_en)[0] ?? $distanceData['meeqat']->name_en }}
                                    </p>
                                    <p class="arabic text-xs text-muted">{{ $distanceData['meeqat']->name_ar }}</p>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0 ml-4">
                                <p class="{{ $isNearest ? 'text-primary-600' : 'text-heading' }} font-bold">
                                    {{ $distanceData['distance_text'] }}
                                </p>
                                <p class="text-muted text-xs">{{ number_format($distanceData['distance_mi'], 1) }} mi</p>
                            </div>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="progress-bar">
                            <div
                                class="distance-bar h-full rounded-full {{ $isNearest ? 'bg-gradient-to-r from-primary-500 to-primary-600' : 'bg-dark-200' }}"
                                style="width: 0%"
                                data-width="{{ $percent }}"
                            ></div>
                        </div>

                        {{-- Links --}}
                        <div class="flex gap-2 mt-3">
                            <a
                                href="{{ $distanceData['meeqat']->google_maps_url }}"
                                target="_blank"
                                class="text-xs flex items-center gap-1 text-muted hover:text-heading bg-surface hover:bg-dark-50 px-2.5 py-1.5 rounded-lg transition-colors border border-border"
                            >
                                📍 Google Maps
                            </a>
                            <a
                                href="{{ $distanceData['meeqat']->waze_url }}"
                                target="_blank"
                                class="text-xs flex items-center gap-1 text-muted hover:text-heading bg-surface hover:bg-dark-50 px-2.5 py-1.5 rounded-lg transition-colors border border-border"
                            >
                                🚗 Waze
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- RESULT MAP --}}
        <div class="card overflow-hidden mb-6 animate-slide-up" style="animation-delay: 0.15s;">
            <div class="p-5 border-b border-border">
                <h3 class="text-heading font-bold">🗺️ Location Map</h3>
            </div>
            <div id="result-map"></div>
        </div>

        {{-- Meeqat Info --}}
        <div class="card p-6 mb-6 animate-slide-up" style="animation-delay: 0.2s;">
            <h3 class="text-heading font-bold mb-4 flex items-center gap-2">
                📖 {{ $result['nearest_meeqat']->name_en }} — Information
            </h3>
            <p class="text-body text-sm leading-relaxed mb-4">
                {{ $result['nearest_meeqat']->description }}
            </p>
            @if($result['nearest_meeqat']->description_ur)
                <p class="urdu text-muted text-sm leading-loose">
                    {{ $result['nearest_meeqat']->description_ur }}
                </p>
            @endif
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 animate-slide-up" style="animation-delay: 0.25s;">
            <a href="{{ route('meeqat.finder') }}" class="btn-outline text-sm py-3 justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Search Again
            </a>

            <button onclick="shareResult()" class="btn-outline text-sm py-3 justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                Share
            </button>

            <a href="{{ $result['nearest_meeqat']->google_maps_url }}" target="_blank" class="btn-outline text-sm py-3 justify-center">
                📍 Google Maps
            </a>

            <a href="{{ route('ihram.index') }}" class="btn-primary text-sm py-3 justify-center">
                📖 Ihram Guide
            </a>
        </div>

        {{-- Guest Prompt --}}
        @guest
            <div class="mt-8 card p-6 text-center animate-slide-up">
                <div class="text-3xl mb-3">🔐</div>
                <h3 class="text-heading font-bold mb-2">Want to Save Your Search History?</h3>
                <p class="text-muted text-sm mb-5">Login to have all your searches automatically saved.</p>
                <div class="flex gap-3 justify-center">
                    <a href="{{ route('login') }}" class="btn-primary py-2.5 px-6 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn-outline py-2.5 px-6 text-sm">Register Free</a>
                </div>
            </div>
        @endguest

    </div>
</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // =========================================
    // COUNTER ANIMATIONS
    // =========================================
    const targetKm = {{ $result['nearest_distance_km'] }};
    const targetMi = {{ $result['nearest']['distance_mi'] ?? 0 }};

    animateNumber('distanceKm', targetKm, 1);
    animateNumber('distanceMi', targetMi, 1);

    function animateNumber(elId, target, decimals) {
        const el  = document.getElementById(elId);
        if (!el)  return;
        let start = 0;
        const step = target / 60;
        const timer = setInterval(() => {
            start += step;
            if (start >= target) {
                el.textContent = target.toFixed(decimals);
                clearInterval(timer);
            } else {
                el.textContent = start.toFixed(decimals);
            }
        }, 20);
    }

    // =========================================
    // PROGRESS BARS ANIMATION
    // =========================================
    setTimeout(() => {
        document.querySelectorAll('.distance-bar').forEach(bar => {
            bar.style.width = bar.dataset.width + '%';
        });
    }, 500);

    // =========================================
    // RESULT MAP
    // =========================================
    const map = L.map('result-map').setView([
        {{ ($log->user_latitude + $result['nearest_meeqat']->latitude) / 2 }},
        {{ ($log->user_longitude + $result['nearest_meeqat']->longitude) / 2 }}
    ], 4);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '© CARTO',
        subdomains: 'abcd',
        maxZoom: 19
    }).addTo(map);

    // User location marker
    const userIcon = L.divIcon({
        html: `<div style="width:16px;height:16px;background:#3b82f6;border-radius:50%;border:3px solid white;box-shadow:0 0 0 5px rgba(59,130,246,0.3);"></div>`,
        className: '',
        iconSize: [22, 22],
        iconAnchor: [11, 11],
    });

    L.marker([{{ $log->user_latitude }}, {{ $log->user_longitude }}], { icon: userIcon })
        .addTo(map)
        .bindPopup('<strong>📍 Your Location</strong>')
        .openPopup();

    // All Meeqat markers
    @foreach($meeqatLocations as $meeqat)
        @php $isNearest = $meeqat->id === $result['nearest_meeqat']->id; @endphp
        L.marker([{{ $meeqat->latitude }}, {{ $meeqat->longitude }}], {
            icon: L.divIcon({
                html: `<div style="
                    width: {{ $isNearest ? '36' : '28' }}px;
                    height: {{ $isNearest ? '36' : '28' }}px;
                    background: {{ $meeqat->color }};
                    border-radius: 50% 50% 50% 0;
                    transform: rotate(-45deg);
                    border: {{ $isNearest ? '4' : '2' }}px solid white;
                    box-shadow: 0 4px 16px rgba(0,0,0,0.5);
                "></div>`,
                className: '',
                iconSize: [{{ $isNearest ? 36 : 28 }}, {{ $isNearest ? 36 : 28 }}],
                iconAnchor: [{{ $isNearest ? 18 : 14 }}, {{ $isNearest ? 36 : 28 }}],
                popupAnchor: [0, -40],
            })
        })
        .addTo(map)
        .bindPopup(`
            <strong style="color: {{ $meeqat->color }}">{{ $isNearest ? '⭐ NEAREST — ' : '' }}{{ $meeqat->name_en }}</strong><br>
            <span style="font-family:serif;direction:rtl;display:block;text-align:right;color:#fbbf24;margin:4px 0;">{{ $meeqat->name_ar }}</span>
            <small style="color:#94a3b8;">{{ $meeqat->for_pilgrims_from }}</small>
        `);
    @endforeach

    // Line connecting user to nearest Meeqat
    const line = L.polyline([
        [{{ $log->user_latitude }}, {{ $log->user_longitude }}],
        [{{ $result['nearest_meeqat']->latitude }}, {{ $result['nearest_meeqat']->longitude }}]
    ], {
        color: '#22c55e',
        weight: 2,
        opacity: 0.7,
        dashArray: '8, 6',
    }).addTo(map);

    // Fit bounds to show both points
    map.fitBounds(line.getBounds(), { padding: [40, 40] });
});

// =========================================
// SHARE
// =========================================
function shareResult() {
    const data = {
        title: 'Meeqat.io — Distance Finder',
        text: `My nearest Meeqat: {{ $result['nearest_meeqat']->name_en }} — {{ number_format($result['nearest_distance_km'], 1) }} km away. Check your Meeqat:`,
        url: '{{ route("meeqat.finder") }}'
    };
    if (navigator.share) {
        navigator.share(data);
    } else {
        navigator.clipboard.writeText(data.text + '\n' + data.url);
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { message: 'Result copied!', type: 'success' }
        }));
    }
}
</script>
@endpush