{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Contact Us - Meeqat.io')

@section('content')

{{-- ══════════════════════════════════════════════════════════
    CONTACT HERO SECTION
    ══════════════════════════════════════════════════════════ --}}
<div class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-mesh"></div>

    {{-- Animated Background Elements --}}
    <div class="absolute inset-0" aria-hidden="true">
        <div class="absolute top-1/3 -left-32 w-80 h-80 bg-primary-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/3 -right-32 w-80 h-80 bg-secondary-500/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                        bg-primary-500/15 border border-primary-500/30
                        text-primary-400 text-caption font-semibold uppercase tracking-wider mb-5
                        animate-fade-in backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-500 animate-pulse" aria-hidden="true"></span>
                Get In Touch
            </div>

            <h1 class="font-heading font-black text-white mb-3 leading-tight"
                style="font-size: clamp(1.75rem, 4vw, 2.5rem);">
                Contact <span class="text-gradient-primary">Us</span>
            </h1>

            <p class="text-body-lg text-dark-400 max-w-xl mx-auto animate-slide-up" style="animation-delay: 0.1s;">
                Have questions or suggestions? We'd love to hear from you.
            </p>
        </div>

        {{-- Contact Form Card --}}
        <div class="card-premium p-8 animate-scale-in">
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-dark-800/50">
                <div class="w-10 h-10 rounded-xl bg-primary-500/15 border border-primary-500/25 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-white font-heading font-semibold text-h4 leading-none">
                        Send us a message
                    </h2>
                    <p class="text-dark-500 text-caption mt-0.5">
                        We typically respond within 24 hours
                    </p>
                </div>
            </div>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-5" novalidate>
                @csrf

                {{-- Name & Email Row --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="contact-name" class="form-label">Name *</label>
                        <input
                            type="text"
                            id="contact-name"
                            name="name"
                            class="form-input"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                        >
                        @error('name')
                            <p class="form-error mt-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="contact-email" class="form-label">Email *</label>
                        <input
                            type="email"
                            id="contact-email"
                            name="email"
                            class="form-input"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                        >
                        @error('email')
                            <p class="form-error mt-1.5">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Subject --}}
                <div>
                    <label for="contact-subject" class="form-label">Subject</label>
                    <input
                        type="text"
                        id="contact-subject"
                        name="subject"
                        class="form-input"
                        value="{{ old('subject') }}"
                        placeholder="What is this about?"
                    >
                </div>

                {{-- Message --}}
                <div>
                    <label for="contact-message" class="form-label">Message *</label>
                    <textarea
                        id="contact-message"
                        name="message"
                        rows="5"
                        class="form-textarea"
                        required
                        placeholder="Tell us how we can help..."
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="form-error mt-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-full btn-lg shadow-glow-green">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                    </svg>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>

@endsection