{{-- resources/views/calculator/chaddar.blade.php --}}
@extends('layouts.app')

@section('title', 'Irani Chaddar Size Calculator')
@section('meta_description', 'Calculate exact fabric meters needed for your Irani Chaddar based on height and style.')

@section('content')

{{-- ── Page Header ─────────────────────────────────────────── --}}
<div class="relative pt-32 pb-10">
    <div class="container-app">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-muted text-sm mb-8" aria-label="Breadcrumb">
            <a href="{{ route('home') }}"
               class="hover:text-primary-600 transition-colors duration-200">
                Home
            </a>
            <svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-primary-600 font-medium">Chaddar Calculator</span>
        </nav>

        {{-- Page Title --}}
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700
                        flex items-center justify-center flex-shrink-0 shadow-btn">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                </svg>
            </div>
            <div>
                <h1 class="font-heading font-black text-heading leading-tight"
                    style="font-size: clamp(1.75rem, 4vw, 2.5rem);">
                    Irani Chaddar
                    <span class="text-primary-600">Size Calculator</span>
                </h1>
                <p class="text-muted text-sm mt-1">
                    Calculate fabric meters according to your height and style
                </p>
            </div>
        </div>
    </div>
</div>

    {{-- ── Main Content ─────────────────────────────────────── --}}
    <div class="container-app pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ══════════════════════════════════════════════
                LEFT: Calculator Form
                ══════════════════════════════════════════════ --}}
            <div class="lg:col-span-2 space-y-6">

            {{-- Main Calculator Card --}}
            <div class="card overflow-hidden"
                 x-data="{
                        unit: 'cm',
                        style: '',
                        heightCm: '',
                        heightFeet: '',
                        heightInch: '0',
                        loading: false,

                        get heightInCm() {
                            if (this.unit === 'cm') return parseFloat(this.heightCm) || 0;
                            const feet = parseInt(this.heightFeet) || 0;
                            const inch = parseInt(this.heightInch) || 0;
                            return Math.round(((feet * 12) + inch) * 2.54 * 100) / 100;
                        },

                        get isValid() {
                            return this.heightInCm >= 100 && this.heightInCm <= 250 && this.style !== '';
                        },

                        get heightDisplay() {
                            return this.heightInCm > 0 ? this.heightInCm.toFixed(1) + ' cm' : '';
                        }
                    }"
                >
                {{-- Card Header --}}
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-heading font-bold text-heading text-xl">Calculator</h2>
                            <p class="text-muted text-sm mt-0.5">Fill in the fields below and click Calculate</p>
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium badge-green">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-500 animate-pulse" aria-hidden="true"></span>
                            Free Tool
                        </div>
                    </div>
                </div>

                <div class="card-body">
                        <form action="{{ route('calculator.chaddar.calculate') }}" method="POST"
                              @submit="loading = true" novalidate>
                            @csrf

                            {{-- ── STEP 1: Height Unit ──────── --}}
                            <fieldset class="mb-8">
                                <div class="flex items-center gap-3 mb-4">
                                <div class="w-7 h-7 rounded-lg bg-primary-50 border border-primary-200 flex items-center justify-center text-xs font-bold text-primary-600 flex-shrink-0" aria-hidden="true">1</div>
                                <legend class="text-heading font-semibold text-sm">Select Height Unit</legend>
                                </div>

                                <div class="grid grid-cols-2 gap-3">

                                    {{-- CM --}}
                                    <label class="cursor-pointer group">
                                    <input type="radio" name="unit" value="cm" x-model="unit" class="sr-only peer" aria-label="Centimeter">
                                    <div class="peer-checked:bg-primary-50 peer-checked:border-primary-500 peer-checked:text-primary-700 rounded-xl p-4 text-center transition-all duration-200 select-none text-muted group-hover:text-heading border-2 border-border bg-surface hover:border-dark-300">
                                            <div class="flex justify-center mb-2">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                                </svg>
                                            </div>
                                            <div class="font-semibold text-sm">Centimeter (CM)</div>
                                            <div class="text-xs mt-0.5 opacity-60">e.g., 170 cm</div>
                                        </div>
                                    </label>

                                    {{-- Feet --}}
                                    <label class="cursor-pointer group">
                                    <input type="radio" name="unit" value="feet" x-model="unit" class="sr-only peer" aria-label="Feet and inches">
                                    <div class="peer-checked:bg-primary-50 peer-checked:border-primary-500 peer-checked:text-primary-700 rounded-xl p-4 text-center transition-all duration-200 select-none text-muted group-hover:text-heading border-2 border-border bg-surface hover:border-dark-300">
                                            <div class="flex justify-center mb-2">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                                </svg>
                                            </div>
                                            <div class="font-semibold text-sm">Feet & Inches</div>
                                            <div class="text-xs mt-0.5 opacity-60">e.g., 5'7"</div>
                                        </div>
                                    </label>
                                </div>
                            </fieldset>

                            {{-- ── STEP 2: Height Input ─────── --}}
                            <fieldset class="mb-8">
                                <div class="flex items-center gap-3 mb-4">
                                <div class="w-7 h-7 rounded-lg bg-primary-50 border border-primary-200 flex items-center justify-center text-xs font-bold text-primary-600 flex-shrink-0" aria-hidden="true">2</div>
                                <legend class="text-heading font-semibold text-sm">Enter Your Height</legend>
                                </div>

                                {{-- CM Input --}}
                                <div x-show="unit === 'cm'"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100">
                                    <div class="relative">
                                        <input
                                            type="number"
                                            name="height_cm"
                                            id="height_cm"
                                            x-model="heightCm"
                                            placeholder="170"
                                            min="100" max="250" step="0.5"
                                            class="form-input text-lg pr-16"
                                        :class="heightCm && (heightCm < 100 || heightCm > 250)
                                            ? 'border-red-500 focus:border-red-500'
                                            : ''"
                                        aria-describedby="cm-hint"
                                    >
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-muted text-sm pointer-events-none">cm</span>
                                </div>
                                <p id="cm-hint" class="form-hint">Valid range: 100 – 250 cm</p>
                                @error('height_cm')
                                    <p class="form-error" role="alert">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Feet Input --}}
                                <div x-show="unit === 'feet'"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="height_feet" class="form-label">Feet</label>
                                            <div class="relative">
                                                <input type="number" name="height_feet" id="height_feet" x-model="heightFeet" placeholder="5" min="4" max="8" class="form-input pr-14">
                                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-muted text-sm pointer-events-none">ft</span>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="height_inch" class="form-label">Inches</label>
                                            <select name="height_inch" id="height_inch" x-model="heightInch" class="form-select">
                                                @for($i = 0; $i <= 11; $i++)
                                                    <option value="{{ $i }}">{{ $i }}"</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Live preview --}}
                                <div x-show="heightInCm > 0"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     class="mt-3 flex items-center gap-2 text-sm text-primary-600" aria-live="polite">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Your height: <strong x-text="heightDisplay"></strong>
                                </div>
                            </fieldset>

                            {{-- ── STEP 3: Style ────────────── --}}
                            <fieldset class="mb-8">
                                <div class="flex items-center gap-3 mb-4">
                                <div class="w-7 h-7 rounded-lg bg-primary-50 border border-primary-200 flex items-center justify-center text-xs font-bold text-primary-600 flex-shrink-0" aria-hidden="true">3</div>
                                <legend class="text-heading font-semibold text-sm">Select Chaddar Style</legend>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                    {{-- Full Body --}}
                                    <label class="cursor-pointer">
                                        <input type="radio" name="style" value="full"
                                               x-model="style" class="sr-only peer" aria-label="Full body style">
                                        <div class="peer-checked:border-primary-500 peer-checked:bg-primary-50 rounded-2xl p-5 h-full transition-all duration-200 select-none border-2 border-border bg-surface hover:border-dark-300">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V5a2 2 0 012-2h14a2 2 0 012 2v16M9 21V12h6v9"/>
                                                </svg>
                                            </div>
                                            <div class="w-5 h-5 rounded-full flex-shrink-0 mt-0.5 transition-all duration-200 border-2 border-muted"
                                                 :style="style === 'full' ? 'border-color: #059669; background: radial-gradient(circle, #059669 40%, transparent 40%)' : ''" aria-hidden="true"></div>
                                        </div>
                                        <h4 class="text-heading font-bold text-sm mb-1.5">Full Body Style</h4>
                                        <p class="text-muted text-xs leading-relaxed">Reaches the feet. More material, maximum coverage. Traditional & Sunnah style.</p>
                                        <div class="mt-3"><span class="badge-green">Recommended</span></div>
                                    </div>
                                </label>

                                {{-- Shoulder --}}
                                <label class="cursor-pointer">
                                    <input type="radio" name="style" value="shoulder" x-model="style" class="sr-only peer" aria-label="Shoulder style">
                                    <div class="peer-checked:border-primary-500 peer-checked:bg-primary-50 rounded-2xl p-5 h-full transition-all duration-200 select-none border-2 border-border bg-surface hover:border-dark-300">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div class="w-5 h-5 rounded-full flex-shrink-0 mt-0.5 transition-all duration-200 border-2 border-muted"
                                                 :style="style === 'shoulder' ? 'border-color: #059669; background: radial-gradient(circle, #059669 40%, transparent 40%)' : ''" aria-hidden="true"></div>
                                        </div>
                                        <h4 class="text-heading font-bold text-sm mb-1.5">Shoulder Style</h4>
                                        <p class="text-muted text-xs leading-relaxed">From shoulder down. Less material, lightweight. Comfortable in warm weather.</p>
                                        <div class="mt-3"><span class="badge-amber">Lightweight</span></div>
                                    </div>
                                </label>
                                </div>

                                @error('style')
                                    <p class="input-error mt-2" role="alert">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </fieldset>

                            {{-- ── Submit ───────────────────── --}}
                            <button
                                type="submit"
                                :disabled="!isValid || loading"
                                class="w-full py-4 rounded-xl font-heading font-bold text-base
                                       transition-all duration-300 flex items-center justify-center gap-3"
                                :class="isValid && !loading
                                    ? 'text-white hover:-translate-y-0.5 cursor-pointer'
                                    : 'cursor-not-allowed'"
                                :style="isValid && !loading
                                    ? 'background: linear-gradient(135deg, #059669, #047857); box-shadow: 0 4px 20px rgba(5,150,105,0.35);'
                                    : 'background: #e5e7eb; color: #9ca3af;'"
                            >
                                <template x-if="!loading">
                                    <span class="flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Calculate Size
                                    </span>
                                </template>
                                <template x-if="loading">
                                    <span class="flex items-center gap-3">
                                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Calculating...
                                    </span>
                                </template>
                            </button>

                            @guest
                                <p class="text-center text-muted text-xs mt-4 flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500 transition-colors">Login</a>
                                    to have your result saved automatically
                                </p>
                            @endguest
                        </form>
                    </div>
                </div>

                            {{-- Size Reference Table --}}
            <div class="card overflow-hidden" x-data="{ activeStyle: 'full' }">
                <div class="card-header flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="text-heading font-heading font-bold flex items-center gap-2 text-base">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Size Reference Table
                        </h3>
                        <p class="text-muted text-xs mt-1">View all sizes by style</p>
                    </div>
                    <div class="flex rounded-xl overflow-hidden border border-border bg-dark-50" role="group" aria-label="Style filter">
                        <button @click="activeStyle = 'full'" class="px-4 py-2 text-sm font-medium transition-all duration-200 focus:outline-none" :class="activeStyle === 'full' ? 'bg-primary-500 text-white' : 'text-muted hover:text-heading'" :aria-pressed="activeStyle === 'full'">Full</button>
                        <button @click="activeStyle = 'shoulder'" class="px-4 py-2 text-sm font-medium transition-all duration-200 focus:outline-none" :class="activeStyle === 'shoulder' ? 'bg-primary-500 text-white' : 'text-muted hover:text-heading'" :aria-pressed="activeStyle === 'shoulder'">Shoulder</button>
                    </div>
                </div>
                @php $svc = app(\App\Services\ChadarSizeService::class); @endphp
                <div x-show="activeStyle === 'full'" x-transition>
                    <div class="overflow-x-auto">
                        <table class="table-modern" aria-label="Full body style sizes">
                            <thead><tr><th scope="col">Size</th><th scope="col">Height Range</th><th scope="col">Height (Feet)</th><th scope="col">Fabric</th></tr></thead>
                            <tbody>
                                @foreach($fullRules as $rule)
                                    <tr>
                                        <td><span class="badge-gray">{{ $rule->size_label }}</span></td>
                                        <td class="font-mono text-xs text-muted">{{ $rule->height_range }}</td>
                                        <td class="text-muted text-xs">{{ $svc->cmToFeet($rule->height_min_cm) }} - {{ $svc->cmToFeet($rule->height_max_cm) }}</td>
                                        <td><span class="text-primary-600 font-bold text-sm">{{ $rule->fabric_meters }}m</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div x-show="activeStyle === 'shoulder'" x-transition style="display:none;">
                    <div class="overflow-x-auto">
                        <table class="table-modern" aria-label="Shoulder style sizes">
                            <thead><tr><th scope="col">Size</th><th scope="col">Height Range</th><th scope="col">Height (Feet)</th><th scope="col">Fabric</th></tr></thead>
                            <tbody>
                                @foreach($shoulderRules as $rule)
                                    <tr>
                                        <td><span class="badge-gray">{{ $rule->size_label }}</span></td>
                                        <td class="font-mono text-xs text-muted">{{ $rule->height_range }}</td>
                                        <td class="text-muted text-xs">{{ $svc->cmToFeet($rule->height_min_cm) }} - {{ $svc->cmToFeet($rule->height_max_cm) }}</td>
                                        <td><span class="text-primary-600 font-bold text-sm">{{ $rule->fabric_meters }}m</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

        {{-- RIGHT: Sidebar --}}
        <div class="space-y-6">

            @auth
                @if($recentCalculations && $recentCalculations->count() > 0)
                    <div class="card card-body">
                        <h3 class="text-heading font-heading font-bold text-sm mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Recent Calculations
                        </h3>
                        <div class="space-y-2">
                            @foreach($recentCalculations as $calc)
                                <a href="{{ route('calculator.chaddar.result', $calc->id) }}"
                                   class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 border border-border hover:border-primary-200 bg-surface hover:bg-primary-50">
                                    <div>
                                        <p class="text-heading text-xs font-medium">{{ $calc->height_cm }}cm - {{ ucfirst($calc->style) }}</p>
                                        <p class="text-muted text-xs mt-0.5">{{ $calc->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-primary-600 font-bold text-sm">{{ $calc->calculated_meters }}m</span>
                                        <p class="text-muted text-xs">{{ $calc->size_label }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('user.history') }}" class="mt-4 flex items-center justify-center gap-2 text-primary-600 hover:text-primary-500 text-xs transition-colors">
                            View all history
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @endif
            @endauth

            <div class="card card-body">
                <h3 class="text-heading font-heading font-bold text-sm mb-5 flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    How It Works
                </h3>
                <ol class="space-y-3">
                    @php $howSteps = ['Enter your height in CM or Feet', 'Choose Full Body or Shoulder style', 'Click Calculate - instant result', 'Share or buy the fabric']; @endphp
                    @foreach($howSteps as $i => $stepText)
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-primary-50 border border-primary-200 flex items-center justify-center text-xs font-bold text-primary-600 flex-shrink-0 mt-0.5" aria-hidden="true">{{ $i + 1 }}</div>
                            <p class="text-muted text-xs leading-relaxed pt-0.5">{{ $stepText }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>

            <div class="card card-body">
                <h3 class="text-heading font-heading font-bold text-sm mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Buying Tips
                </h3>
                <ul class="space-y-2.5" role="list">
                    @foreach(['Always prefer pure cotton fabric', 'Egyptian cotton is the best quality', 'Keep extra 0.5 meter for tailoring', 'Pre-washed fabric prevents shrinkage', 'White or off-white color is traditional', 'Fabric should be seamless for Ihram'] as $tip)
                        <li class="flex items-start gap-2 text-xs text-muted">
                            <svg class="w-3.5 h-3.5 text-primary-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $tip }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="card card-body">
                <h3 class="text-muted font-semibold text-xs uppercase tracking-widest mb-3">Other Tools</h3>
                <nav aria-label="Other tools">
                    @php
                        $tools = [
                            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',    'label' => 'Meeqat Finder',     'route' => 'meeqat.finder', 'color' => '#3b82f6'],
                            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>', 'label' => 'Duas & Niyat',      'route' => 'duas.index',    'color' => '#059669'],
                            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',                                                                    'label' => 'Ihram Guide',       'route' => 'ihram.index',   'color' => '#d97706'],
                            ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',                                                                             'label' => 'Virtual Try-On',    'route' => 'tryon.index',   'color' => '#8b5cf6'],
                        ];
                    @endphp
                    @foreach($tools as $tool)
                        <a href="{{ route($tool['route']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group hover:bg-primary-50">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color: {{ $tool['color'] }};" aria-hidden="true">{!! $tool['icon'] !!}</svg>
                            <span class="text-muted group-hover:text-heading text-xs font-medium transition-colors">{{ $tool['label'] }}</span>
                            <svg class="w-3.5 h-3.5 text-muted group-hover:text-primary-500 ml-auto transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endforeach
                </nav>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection