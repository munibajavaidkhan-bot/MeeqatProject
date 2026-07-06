@extends('layouts.app')

@section('title', 'Meeqat Distance Finder')
@section('meta_description', 'Find the nearest Meeqat from your location with exact distance using GPS.')

@push('head')
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #meeqat-map {
            height: 400px;
            border-radius: 1rem;
            z-index: 1;
        }
        .leaflet-popup-content-wrapper {
            background: #1e293b;
            color: #e2e8f0;
            border: 1px solid #334155;
            border-radius: 12px;
        }
        .leaflet-popup-tip {
            background: #1e293b;
        }
        .leaflet-popup-content { margin: 12px 16px; }
        .custom-meeqat-marker {
            width: 36px;
            height: 36px;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            border: 3px solid white;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
        }
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.5); opacity: 0.8; }
            100% { transform: scale(2); opacity: 0; }
        }
    </style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="relative pt-32 pb-16 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 left-1/3 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-1/3 w-80 h-80 bg-primary-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-3 text-muted text-sm mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-primary-600">Meeqat Distance Finder</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-glow-green">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-heading">
                        Meeqat <span class="text-primary-600">Distance Finder</span>
                    </h1>
                    <p class="text-muted mt-1">Find your nearest Meeqat and distance using GPS</p>
                </div>
            </div>

            {{-- Stats Badge --}}
            <div class="flex items-center gap-3">
                <div class="card px-4 py-2.5 flex items-center gap-2">
                    <span class="text-primary-600 font-bold text-lg">{{ number_format($totalSearches) }}</span>
                    <span class="text-muted text-sm">Total Searches</span>
                </div>
                <a href="{{ route('meeqat.locations') }}" class="btn-outline text-sm py-2.5 px-4">
                    All Meeqat
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20"
     x-data="{
        method: 'gps',
        gpsLoading: false,
        gpsError: '',
        gpsSuccess: false,
        lat: '',
        lon: '',
        formReady: false,
        mapInitialized: false,

        async detectGPS() {
            this.gpsLoading = true;
            this.gpsError   = '';
            this.gpsSuccess = false;

            if (!navigator.geolocation) {
                this.gpsError   = 'Your browser does not support GPS. Use Manual mode instead.';
                this.gpsLoading = false;
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    this.lat        = position.coords.latitude.toFixed(6);
                    this.lon        = position.coords.longitude.toFixed(6);
                    this.gpsSuccess = true;
                    this.gpsLoading = false;
                    this.formReady  = true;
                    this.updateUserMarker(this.lat, this.lon);
                },
                (error) => {
                    const errors = {
                    1: 'Location permission denied. Please allow in Settings or use Manual mode.',
                    2: 'Location unavailable. Try again or use Manual mode.',
                    3: 'Request timeout. Please try again.',
                    };
                    this.gpsError   = errors[error.code] || 'Unknown GPS error.';
                    this.gpsLoading = false;
                },
                { timeout: 10000, enableHighAccuracy: true }
            );
        },

        updateUserMarker(lat, lon) {
            if (window.meeqatMap && window.userMarker) {
                window.userMarker.setLatLng([lat, lon]);
                window.meeqatMap.flyTo([lat, lon], 5, { duration: 1.5 });
            }
        }
     }"
>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- =============================================
            FORM SECTION
            ============================================= --}}
        <div class="lg:col-span-1 space-y-6">

            {{-- Detection Method Tabs --}}
            <div class="card overflow-hidden">
                {{-- Tab Header --}}
                <div class="flex border-b border-border">
                    <button
                        @click="method = 'gps'"
                        class="flex-1 py-4 text-sm font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                        :class="method === 'gps'
                            ? 'bg-primary-50 text-primary-700 border-b-2 border-primary-500'
                            : 'text-muted hover:text-heading hover:bg-dark-50'"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        GPS Auto
                    </button>
                    <button
                        @click="method = 'manual'"
                        class="flex-1 py-4 text-sm font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                        :class="method === 'manual'
                            ? 'bg-primary-50 text-primary-700 border-b-2 border-primary-500'
                            : 'text-muted hover:text-heading hover:bg-dark-50'"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Manual
                    </button>
                </div>

                <div class="p-6">
                    <form action="{{ route('meeqat.calculate') }}" method="POST" id="meeqatForm">
                        @csrf
                        <input type="hidden" name="method" :value="method">
                        <input type="hidden" name="latitude"  :value="lat">
                        <input type="hidden" name="longitude" :value="lon">

                        {{-- GPS Panel --}}
                        <div x-show="method === 'gps'" x-transition>
                            <div class="text-center py-4">
                                {{-- GPS Icon Animated --}}
                                <div class="relative inline-flex mb-6">
                                    <div class="w-20 h-20 rounded-full bg-primary-500/20 border-2 border-primary-500/40 flex items-center justify-center text-3xl">
                                        <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <template x-if="gpsLoading">
                                        <div class="absolute inset-0 rounded-full border-2 border-primary-500 pulse-ring"></div>
                                    </template>
                                    <template x-if="gpsSuccess">
                                        <div class="absolute -top-1 -right-1 w-7 h-7 rounded-full bg-primary-500 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </template>
                                </div>

                                {{-- GPS Error --}}
                                <template x-if="gpsError">
                                    <div class="alert-error text-left mb-4">
                                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <p class="text-sm" x-text="gpsError"></p>
                                    </div>
                                </template>

                                {{-- GPS Success --}}
                                <template x-if="gpsSuccess">
                                    <div class="alert-success text-left mb-4">
                                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <div>
                                            <p class="text-sm font-semibold">Location Detected!</p>
                                            <p class="text-xs mt-0.5 opacity-80">
                                                Lat: <span x-text="parseFloat(lat).toFixed(4)"></span>,
                                                Lon: <span x-text="parseFloat(lon).toFixed(4)"></span>
                                            </p>
                                        </div>
                                    </div>
                                </template>

                                {{-- Default State --}}
                                <template x-if="!gpsSuccess && !gpsError && !gpsLoading">
                                    <div class="mb-4">
                                        <p class="text-heading font-semibold mb-1">Automatic GPS Detection</p>
                                        <p class="text-muted text-sm">Press the button — your browser will automatically detect your location</p>
                                    </div>
                                </template>

                                {{-- Detect Button --}}
                                <button
                                    type="button"
                                    @click="detectGPS()"
                                    :disabled="gpsLoading"
                                    class="w-full py-3.5 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center gap-2 mb-3"
                                    :class="gpsLoading
                                        ? 'bg-dark-100 text-muted cursor-not-allowed'
                                        : 'bg-blue-50 border border-blue-200 text-blue-700 hover:bg-blue-100'"
                                >
                                    <template x-if="!gpsLoading">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Detect My Location
                                        </span>
                                    </template>
                                    <template x-if="gpsLoading">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            Detecting Location...
                                        </span>
                                    </template>
                                </button>
                            </div>
                        </div>

                        {{-- Manual Panel --}}
                        <div x-show="method === 'manual'" x-transition>
                            <div class="space-y-4">
                                <div class="alert-info">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-xs">Enter your country or city — the system will automatically find coordinates</p>
                                </div>

                                <div>
                                    <label class="input-label">Country <span class="text-red-400">*</span></label>
                                    <select name="country" class="select-field" @change="formReady = $event.target.value !== ''">
                                        <option value="">-- Select Country --</option>
                                        @foreach([
                                            'Pakistan', 'India', 'Bangladesh', 'Indonesia', 'Malaysia',
                                            'Turkey', 'Egypt', 'Iran', 'Iraq', 'Saudi Arabia',
                                            'UAE', 'Kuwait', 'Qatar', 'Bahrain', 'Oman',
                                            'Jordan', 'Syria', 'Morocco', 'Algeria', 'Tunisia',
                                            'Nigeria', 'United Kingdom', 'United States', 'Canada', 'Australia',
                                            'France', 'Germany', 'Netherlands', 'Belgium',
                                        ] as $c)
                                            <option value="{{ $c }}" {{ old('country') === $c ? 'selected' : '' }}>
                                                {{ $c }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <p class="input-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="input-label">City (Optional)</label>
                                    <input
                                        type="text"
                                        name="city"
                                        value="{{ old('city') }}"
                                        placeholder="e.g. Karachi, Istanbul..."
                                        class="input-field"
                                    >
                                    <p class="text-muted text-xs mt-1.5">Providing a city gives more accurate results</p>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button
                            type="submit"
                            :disabled="method === 'gps' && !formReady"
                            class="w-full mt-5 py-4 rounded-xl font-bold text-base flex items-center justify-center gap-2 transition-all duration-300"
                            :class="(method === 'manual' || formReady)
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-glow-green hover:from-primary-400 hover:to-primary-500 hover:-translate-y-0.5'
                                : 'bg-dark-100 text-muted cursor-not-allowed'"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Calculate Meeqat Distance
                        </button>
                    </form>
                </div>
            </div>

            {{-- Last Search (Logged in) --}}
            @auth
                @if($lastSearch)
                    <div class="card p-5">
                        <h3 class="text-heading font-semibold mb-3 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Your Previous Search
                        </h3>
                        <a href="{{ route('meeqat.result', $lastSearch->id) }}" class="block p-3 rounded-xl bg-surface hover:bg-dark-50 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-heading font-semibold text-sm">
                                    {{ $lastSearch->nearestMeeqat->name_en ?? 'N/A' }}
                                </span>
                                <span class="badge-green text-xs">
                                    {{ number_format($lastSearch->nearest_distance_km, 1) }} km
                                </span>
                            </div>
                            <p class="text-muted text-xs">
                                {{ $lastSearch->created_at->diffForHumans() }} •
                                {{ ucfirst($lastSearch->detection_method) }}
                            </p>
                        </a>
                    </div>
                @endif
            @endauth

            {{-- Info Card --}}
            <div class="card p-5">
                <h3 class="text-heading font-semibold mb-4 flex items-center gap-2">
                    <span class="text-primary-600">ℹ️</span> What is Meeqat?
                </h3>
                <p class="text-muted text-sm leading-relaxed mb-4">
                    Meeqat is the boundary where pilgrims must enter the state of Ihram before crossing for Hajj or Umrah. Crossing without Ihram is not permissible.
                </p>
                <div class="space-y-2">
                    @foreach($meeqatLocations as $loc)
                        <div class="flex items-center gap-2.5 p-2.5 rounded-lg hover:bg-dark-50 transition-colors">
                            <span class="text-lg">{{ $loc->icon }}</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-heading text-xs font-medium truncate">{{ $loc->name_en }}</p>
                                <p class="text-muted text-xs font-arabic">{{ $loc->name_ar }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- =============================================
            MAP SECTION
            ============================================= --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Map Card --}}
            <div class="card overflow-hidden">
                <div class="p-5 border-b border-border flex items-center justify-between">
                    <div>
                        <h2 class="text-heading font-bold flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Interactive Map
                        </h2>
                        <p class="text-muted text-xs mt-0.5">5 Meeqat locations — click to see details</p>
                    </div>
                    <div class="flex gap-2">
                        <button
                            onclick="resetMapView()"
                            class="btn-outline text-xs py-1.5 px-3"
                        >
                            Reset View
                        </button>
                    </div>
                </div>
                <div id="meeqat-map"></div>
            </div>

            {{-- All Meeqat Cards --}}
            <div>
                <h3 class="text-heading font-bold mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 bg-primary-500 rounded-full"></span>
                    All Meeqat Locations (5)
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($meeqatLocations as $loc)
                        <div class="card group hover:border-primary-200 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                            <div class="p-5">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl border {{ $loc->bg_color_class }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-heading font-semibold text-sm">{{ explode('(', $loc->name_en)[0] }}</h4>
                                            <p class="arabic text-xs" style="color: {{ $loc->color }}; font-size: 0.85rem;">{{ $loc->name_ar }}</p>
                                        </div>
                                    </div>
                                    <button
                                        onclick="flyToMeeqat({{ $loc->latitude }}, {{ $loc->longitude }}, '{{ addslashes($loc->name_en) }}')"
                                        class="text-muted hover:text-primary-600 transition-colors p-1"
                                        title="View on map"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v10.764a1 1 0 01-1.447.894L15 18M15 10l-4.553-2.276A1 1 0 009 8.618v10.764a1 1 0 001.447.894L15 18M15 10V18"/>
                                        </svg>
                                    </button>
                                </div>

                                <p class="text-muted text-xs mb-3 leading-relaxed line-clamp-2">
                                    {{ $loc->for_pilgrims_from }}
                                </p>

                                <div class="flex items-center gap-2">
                                    <a
                                        href="{{ $loc->google_maps_url }}"
                                        target="_blank"
                                        class="flex items-center gap-1.5 text-xs text-muted hover:text-heading bg-dark-50 hover:bg-dark-100 px-3 py-1.5 rounded-lg transition-colors"
                                    >
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        Google Maps
                                    </a>
                                    <span class="text-muted text-xs font-mono">
                                        {{ number_format($loc->latitude, 4) }}, {{ number_format($loc->longitude, 4) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Ihram Reminder Card --}}
            <div class="relative rounded-2xl overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-secondary-900/50 via-dark-900 to-dark-900 rounded-2xl"></div>
                <div class="relative p-6 flex items-start gap-4">
                    <div class="text-4xl flex-shrink-0">🕌</div>
                    <div>
                        <h3 class="text-secondary-300 font-bold text-lg mb-2">Time to Prepare for Ihram</h3>
                        <p class="text-dark-300 text-sm leading-relaxed">
                            It is obligatory to put on Ihram <strong class="text-white">before</strong> crossing the Meeqat.
                            Crossing the Meeqat without Ihram is <strong class="text-red-400">not permissible</strong> —
                            doing so requires a sacrifice (Dam).
                        </p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="{{ route('ihram.index') }}" class="btn-gold text-sm py-2 px-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                View Ihram Rules
                            </a>
                            <a href="{{ route('niyat.index') }}" class="btn-outline text-sm py-2 px-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                View Niyat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// =========================================
// MAP INITIALIZATION
// =========================================
const meeqatData = @json($mapData);

// Map initialize
window.meeqatMap = L.map('meeqat-map', {
    center: [22.0, 40.0],
    zoom: 5,
    zoomControl: true,
}).setView([22.0, 40.0], 5);

// Dark tile layer
L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap contributors © CARTO',
    subdomains: 'abcd',
    maxZoom: 19
}).addTo(window.meeqatMap);

// Meeqat markers add karo
const meeqatMarkers = [];

meeqatData.forEach(function(meeqat) {
    // Custom icon
    const markerHtml = `
        <div style="
            width: 32px; height: 32px;
            background: ${meeqat.color};
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            border: 3px solid rgba(255,255,255,0.8);
            box-shadow: 0 4px 16px rgba(0,0,0,0.5);
        "></div>
    `;

    const icon = L.divIcon({
        html: markerHtml,
        className: '',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -36],
    });

    const marker = L.marker([meeqat.lat, meeqat.lng], { icon })
        .addTo(window.meeqatMap)
        .bindPopup(`
            <div style="min-width: 200px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                    <span style="font-size: 1.2rem;">${meeqat.icon}</span>
                    <strong style="color: ${meeqat.color}; font-size: 0.9rem;">${meeqat.name_en.split('(')[0].trim()}</strong>
                </div>
                <p style="font-family: serif; font-size: 1rem; text-align: right; direction: rtl; color: #fbbf24; margin-bottom: 6px;">${meeqat.name_ar}</p>
                <p style="font-size: 0.7rem; color: #94a3b8; margin-bottom: 10px; line-height: 1.4;">${meeqat.for}</p>
                <a href="${meeqat.gmaps_url}" target="_blank"
                   style="display: inline-flex; align-items: center; gap: 4px; padding: 6px 10px; background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); border-radius: 8px; color: #4ade80; font-size: 0.7rem; text-decoration: none;">
                   📍 Google Maps
                </a>
            </div>
        `);

    meeqatMarkers.push(marker);
});

// User location marker (initially hidden)
const userIcon = L.divIcon({
    html: `
        <div style="position: relative; display: flex; align-items: center; justify-content: center;">
            <div style="
                width: 16px; height: 16px;
                background: #3b82f6;
                border-radius: 50%;
                border: 3px solid white;
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);
                z-index: 2;
            "></div>
        </div>
    `,
    className: '',
    iconSize: [24, 24],
    iconAnchor: [12, 12],
});

window.userMarker = L.marker([0, 0], { icon: userIcon });

// =========================================
// MAP CONTROLS
// =========================================

function resetMapView() {
    window.meeqatMap.flyTo([22.0, 40.0], 5, { duration: 1 });
}

function flyToMeeqat(lat, lng, name) {
    window.meeqatMap.flyTo([lat, lng], 9, { duration: 1.5 });
    setTimeout(() => {
        meeqatMarkers.forEach(m => {
            if (Math.abs(m.getLatLng().lat - lat) < 0.01) {
                m.openPopup();
            }
        });
    }, 1600);
}

// =========================================
// GPS UPDATE
// =========================================
document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
        // Watch Alpine lat/lon values
    });
});
</script>
@endpush