@extends('layouts.guest')
@section('title', 'Login — Meeqat.io')

<div x-data="{ showPass: false, loading: false }">

    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 border border-primary-400 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-primary-500/30">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-black text-heading tracking-tight">Welcome Back!</h1>
        <p class="text-muted text-sm mt-2 font-medium">Login to access your Meeqat dashboard</p>
    </div>

    {{-- Session Error --}}
    @if($errors->any())
        <div class="alert-error mb-6">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                @foreach($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" @submit="loading = true">
        @csrf

        {{-- Email --}}
        <div class="mb-5">
            <label class="form-label">
                Email Address <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="yourname@email.com"
                    required
                    autofocus
                    autocomplete="email"
                    class="form-input pl-12 @error('email') border-red-500 @enderror"
                >
            </div>
            @error('email')
                <p class="form-error mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-5">
            <div class="flex items-center justify-between mb-2">
                <label class="form-label mb-0">
                    Password <span class="text-red-500">*</span>
                </label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary-600 text-xs hover:text-primary-500 transition-colors hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    :type="showPass ? 'text' : 'password'"
                    name="password"
                    placeholder="********"
                    required
                    autocomplete="current-password"
                    class="form-input pl-12 pr-12 @error('password') border-red-500 @enderror"
                >
                <button
                    type="button"
                    @click="showPass = !showPass"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-muted hover:text-heading transition-colors"
                >
                    <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="form-error mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center gap-3 cursor-pointer group">
                <div class="relative">
                    <input type="checkbox" name="remember" id="remember" class="sr-only peer">
                    <div class="w-10 h-5 bg-dark-200 peer-checked:bg-primary-500 rounded-full transition-colors duration-300 border border-dark-300 peer-checked:border-primary-500"></div>
                    <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-5 shadow-sm"></div>
                </div>
                <span class="text-muted text-sm group-hover:text-heading transition-colors">Remember me</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <button
            type="submit"
            :disabled="loading"
            class="btn btn-primary w-full btn-lg"
        >
            <template x-if="!loading">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Login to Meeqat.io
                </span>
            </template>
            <template x-if="loading">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Logging in...
                </span>
            </template>
        </button>
    </form>

    {{-- Divider --}}
    <div class="flex items-center gap-4 my-6">
        <div class="flex-1 h-px bg-border"></div>
        <span class="text-muted text-xs">OR</span>
        <div class="flex-1 h-px bg-border"></div>
    </div>

    {{-- Register Link --}}
    <div class="text-center">
        <p class="text-muted text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary-600 font-semibold hover:text-primary-500 transition-colors hover:underline ml-1">
                Register Free &rarr;
            </a>
        </p>
    </div>

    {{-- Back to Home --}}
    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="text-muted hover:text-heading text-sm transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Meeqat.io
        </a>
    </div>
</div>
