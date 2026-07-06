{{-- resources/views/calculator/chaddar-result.blade.php --}}
@extends('layouts.app')

@section('title', 'Chaddar Size Result — ' . $result['size_label'])

@section('content')

<div class="relative pt-32 pb-20 min-h-screen">

    {{-- Background --}}
    <div class="absolute inset-0 bg-mesh" aria-hidden="true"></div>
    <div class="absolute top-20 left-1/4 w-80 h-80 bg-primary-500/10 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="absolute bottom-20 right-1/4 w-80 h-80 bg-secondary-500/8 rounded-full blur-3xl" aria-hidden="true"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Back Button --}}
        <a href="{{ route('calculator.chaddar') }}"
           class="inline-flex items-center gap-2 text-dark-400 hover:text-primary-400
                  text-sm mb-8 transition-colors duration-200 group">
            <svg class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-1"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Calculator
        </a>

        {{-- Success Header --}}
        <div class="text-center mb-8 animate-slide-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                         bg-primary-500/10 border border-primary-500/30
                         text-primary-400 text-sm font-medium mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Calculation Complete
            </div>
            <h1 class="font-heading font-black text-white text-h1">
                Your Chaddar <span class="gradient-text">Size is Ready!</span>
            </h1>
        </div>

        {{-- ── MAIN RESULT CARD ────────────────────────────── --}}
        <div class="relative card-premium overflow-hidden mb-6 animate-slide-up">

            {{-- Top gradient bar --}}
            <div class="h-1 w-full bg-gradient-to-r from-primary-500 via-secondary-500 to-primary-500"
                 aria-hidden="true"></div>

            {{-- BG decoration --}}
            <div class="absolute top-0 right-0 w-48 h-48 bg-primary-500/5 rounded-full
                        -translate-y-1/2 translate-x-1/2 pointer-events-none"
                 aria-hidden="true"></div>

            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- Fabric Meters Counter --}}
                    <div class="md:col-span-1 flex flex-col items-center justify-center text-center p-6
                                rounded-2xl bg-gradient-to-br from-primary-500/20 to-primary-600/10
                                border border-primary-500/30">
                        <p class="text-primary-300 text-xs font-semibold uppercase tracking-widest mb-2">
                            Fabric Required
                        </p>
                        <div class="font-heading font-black text-white mb-1"
                             style="font-size: 4.5rem; line-height: 1;"
                             id="metersCounter"
                             aria-label="{{ $result['fabric_meters'] }} meters">0</div>
                        <p class="text-primary-400 text-xl font-bold font-heading">Meters</p>
                        <div class="mt-4">
                            <span class="badge-green text-sm px-4 py-1.5">
                                Size {{ $result['size_label'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Detail Grid --}}
                    <div class="md:col-span-2 grid grid-cols-2 gap-4">

                        @php
                            $details = [
                                [
                                    'label' => 'Height (CM)',
                                    'value' => $result['height_cm'] . ' cm',
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>',
                                    'color' => 'text-blue-400',
                                ],
                                [
                                    'label' => 'Height (Feet)',
                                    'value' => $result['height_feet'],
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>',
                                    'color' => 'text-cyan-400',
                                ],
                                [
                                    'label' => 'Style',
                                    'value' => $result['style_label'],
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                                    'color' => 'text-purple-400',
                                ],
                                [
                                    'label' => 'Height Range',
                                    'value' => $result['height_range'],
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                                    'color' => 'text-secondary-400',
                                ],
                            ];
                        @endphp

                        @foreach($details as $detail)
                            <div class="p-4 rounded-xl bg-dark-800/60 border border-dark-700/50">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 flex-shrink-0 {{ $detail['color'] }}"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                                         aria-hidden="true">
                                        {!! $detail['icon'] !!}
                                    </svg>
                                    <p class="text-dark-400 text-xs font-medium uppercase tracking-wider">
                                        {{ $detail['label'] }}
                                    </p>
                                </div>
                                <p class="text-white font-bold text-lg {{ $detail['color'] }}">
                                    {{ $detail['value'] }}
                                </p>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Tip --}}
                <div class="mt-6 alert-info" role="note" aria-label="Style tip">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <p class="text-sm leading-relaxed">{{ $result['tip'] }}</p>
                </div>
            </div>
        </div>

        {{-- ── BUYING TIPS ─────────────────────────────────── --}}
        <div class="card-premium p-6 mb-6 animate-slide-up" style="animation-delay: 0.1s;">
            <h3 class="text-white font-heading font-bold text-h4 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Fabric Buying Tips
                <span class="badge-green ml-1">Size {{ $result['size_label'] }}</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                @foreach($result['buying_tips'] as $tip)
                    <div class="flex items-start gap-2 p-3 rounded-xl bg-dark-800/60 border border-dark-700/50">
                        <svg class="w-4 h-4 text-primary-500 flex-shrink-0 mt-0.5"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <p class="text-dark-300 text-sm">{{ $tip }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ── SIZE COMPARISON TABLE ──────────────────────── --}}
        <div class="card-premium overflow-hidden mb-6 animate-slide-up" style="animation-delay: 0.15s;">
            <div class="p-5 border-b border-dark-800/80">
                <h3 class="text-white font-heading font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    {{ $result['style_label'] }} — All Sizes
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="table-premium" aria-label="Size comparison for {{ $result['style_label'] }}">
                    <thead>
                        <tr>
                            <th scope="col">Size</th>
                            <th scope="col">Height Range</th>
                            <th scope="col">Fabric</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allRules as $rule)
                            @php $isYours = $rule->size_label === $result['size_label']; @endphp
                            <tr class="{{ $isYours ? 'bg-primary-500/5' : '' }}">
                                <td>
                                    <span class="badge {{ $isYours ? 'badge-green' : 'badge-gray' }}">
                                        {{ $rule->size_label }}
                                    </span>
                                </td>
                                <td class="font-mono text-sm">{{ $rule->height_range }}</td>
                                <td>
                                    <span class="text-primary-400 font-bold">{{ $rule->fabric_meters }}m</span>
                                </td>
                                <td>
                                    @if($isYours)
                                        <span class="badge-green flex items-center gap-1 w-fit">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Your Size
                                        </span>
                                    @else
                                        <span class="text-dark-600 text-xs" aria-hidden="true">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── ACTION BUTTONS ──────────────────────────────── --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 animate-slide-up" style="animation-delay: 0.2s;">

            {{-- Recalculate --}}
            <a href="{{ route('calculator.chaddar') }}"
               class="btn btn-outline justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Again
            </a>

            {{-- Share --}}
            <button onclick="shareResult()"
                    class="btn btn-outline justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
                Share
            </button>

            {{-- Copy --}}
            <button id="copyBtn"
                    onclick="copyResult()"
                    class="btn btn-outline justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Copy
            </button>

            {{-- Print --}}
            <button onclick="window.print()"
                    class="btn btn-primary justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print
            </button>
        </div>

        {{-- ── GUEST LOGIN PROMPT ───────────────────────────── --}}
        @guest
            <div class="mt-8 card-glass p-6 text-center animate-slide-up" style="animation-delay: 0.25s;">
                <div class="w-12 h-12 rounded-2xl bg-primary-500/15 border border-primary-500/25
                            flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-white font-heading font-bold text-h4 mb-2">Want to Save Your Result?</h3>
                <p class="text-dark-400 text-sm mb-5">
                    Login to have this result automatically saved so you can view it later.
                </p>
                <div class="flex gap-3 justify-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login Now</a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-sm">Create Free Account</a>
                </div>
            </div>
        @endguest

    </div>
</div>

@endsection

@push('scripts')
<script>
// Counter Animation
document.addEventListener('DOMContentLoaded', function () {
    const target = {{ (float) $result['fabric_meters'] }};
    const el     = document.getElementById('metersCounter');
    if (!el) return;

    let current = 0;
    const steps = 60;
    const step  = target / steps;

    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            el.textContent = target.toFixed(2);
            clearInterval(timer);
        } else {
            el.textContent = current.toFixed(2);
        }
    }, 25);
});

// Copy Result
function copyResult() {
    const text = `Meeqat.io — Chaddar Size Calculator\n\n` +
                 `Height: {{ $result['height_cm'] }} cm ({{ $result['height_feet'] }})\n` +
                 `Style:  {{ $result['style_label'] }}\n` +
                 `Size:   {{ $result['size_label'] }}\n` +
                 `Fabric: {{ $result['fabric_meters'] }} Meters\n\n` +
                 `Calculate yours: ${window.location.origin}{{ route('calculator.chaddar') }}`;

    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copyBtn');
        const original = btn.innerHTML;
        btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Copied!`;
        setTimeout(() => { btn.innerHTML = original; }, 3000);
    });
}

// Share Result
function shareResult() {
    const shareData = {
        title: 'Meeqat.io — Chaddar Size Calculator',
        text:  `My height is {{ $result['height_cm'] }} cm. I need {{ $result['fabric_meters'] }} meters of fabric (Size {{ $result['size_label'] }}). Check your size:`,
        url:   '{{ route("calculator.chaddar") }}'
    };

    if (navigator.share) {
        navigator.share(shareData);
    } else {
        copyResult();
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { message: 'Link copied! Share it with your family.', type: 'success' }
        }));
    }
}
</script>

<style>
@media print {
    nav, footer, .btn, a[href="{{ route('calculator.chaddar') }}"] { display: none !important; }
    body { background: #fff !important; color: #111 !important; }
    .card-premium { border: 1px solid #ccc !important; background: #fff !important; }
}
</style>
@endpush