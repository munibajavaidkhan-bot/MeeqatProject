<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Meeqat.io</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-950 min-h-screen font-sans antialiased" x-data>

    {{-- Background --}}
    <div class="fixed inset-0 bg-mesh"></div>
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -left-40 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 -right-40 w-96 h-96 bg-gold-500/8 rounded-full blur-3xl animate-pulse-slow" style="animation-delay:2s"></div>
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 50px 50px;">
        </div>
    </div>

    <div class="relative min-h-screen flex">

        {{-- ============================================
            LEFT SIDE — Decorative
            ============================================ --}}
        <div class="hidden lg:flex lg:w-1/2 flex-col items-center justify-center p-12 relative">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 mb-16 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-glow-green group-hover:scale-110 transition-transform duration-300">
                    <span class="text-white font-black text-lg">M</span>
                </div>
                <div>
                    <span class="text-white font-black text-2xl">Meeqat<span class="text-primary-400">.io</span></span>
                    <p class="text-dark-500 text-xs">Smart Hajj & Umrah Companion</p>
                </div>
            </a>

            {{-- Content --}}
            <div class="w-full max-w-sm">
                <h2 class="text-3xl font-black text-white mb-4 leading-tight">
                    New Password<br>
                    <span class="text-primary-400">Set It Now!</span>
                </h2>
                <p class="text-dark-400 text-sm leading-relaxed mb-10">
                    Enter your new password. Create a strong password that you can remember.
                </p>

                {{-- Password Tips --}}
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm">💡 Strong Password Tips:</h3>
                    @foreach([
                        ['✅', 'Minimum 8 characters required'],
                        ['✅', 'Include a capital letter (A-Z)'],
                        ['✅', 'Include a number (0-9)'],
                        ['✅', 'Include a special character (!@#$)'],
                        ['❌', 'Don\'t use your name or birthday'],
                        ['❌', 'Don't use 123456 or "password"'],
                    ] as $tip)
                        <div class="flex items-center gap-3">
                            <span class="text-base flex-shrink-0">{{ $tip[0] }}</span>
                            <p class="text-dark-400 text-sm">{{ $tip[1] }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Security Note --}}
                <div class="mt-10 p-4 rounded-2xl bg-dark-800/50 border border-dark-700">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl flex-shrink-0">🛡️</span>
                        <div>
                            <p class="text-white font-semibold text-sm mb-1">Account Security</p>
                            <p class="text-dark-500 text-xs leading-relaxed">
                                After resetting your password, you will be logged out on all devices. Login with your new password.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================
            RIGHT SIDE — Reset Password Form
            ============================================ --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md animate-slide-up">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center justify-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-glow-green">
                        <span class="text-white font-black">M</span>
                    </div>
                    <span class="text-white font-black text-xl">Meeqat<span class="text-primary-400">.io</span></span>
                </div>

                {{-- Form Card --}}
                <div class="card-premium p-8 md:p-10">

                    {{-- Header --}}
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500/20 to-primary-600/10 border border-primary-500/30 flex items-center justify-center text-3xl mx-auto mb-4 animate-float">
                            🔒
                        </div>
                        <h1 class="text-2xl font-black text-white">Set New Password</h1>
                        <p class="text-dark-400 text-sm mt-1">Enter your new secure password</p>
                    </div>

                    {{-- Errors --}}
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

                    {{-- Reset Form --}}
                    <form
                        method="POST"
                        action="{{ route('password.store') }}"
                        x-data="{
                            showPass: false,
                            showConfirm: false,
                            loading: false,
                            password: '',
                            strength: 0,
                            getStrength() {
                                let s = 0;
                                if (this.password.length >= 8) s++;
                                if (/[A-Z]/.test(this.password)) s++;
                                if (/[0-9]/.test(this.password)) s++;
                                if (/[^A-Za-z0-9]/.test(this.password)) s++;
                                this.strength = s;
                            }
                        }"
                        @submit="loading = true"
                    >
                        @csrf

                        {{-- Hidden Token --}}
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        {{-- Email --}}
                        <div class="mb-5">
                            <label class="input-label">
                                Email Address <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-dark-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $request->email) }}"
                                    placeholder="your@email.com"
                                    required
                                    autocomplete="email"
                                    class="input-field pl-12 @error('email') border-red-500/50 @enderror"
                                >
                            </div>
                            @error('email')
                                <p class="input-error mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="mb-5">
                            <label class="input-label">
                                New Password <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-dark-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input
                                    :type="showPass ? 'text' : 'password'"
                                    name="password"
                                    x-model="password"
                                    @input="getStrength()"
                                    placeholder="Min 8 characters"
                                    required
                                    autocomplete="new-password"
                                    class="input-field pl-12 pr-12 @error('password') border-red-500/50 @enderror"
                                >
                                <button
                                    type="button"
                                    @click="showPass = !showPass"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-dark-400 hover:text-white transition-colors"
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

                            {{-- Strength Bar --}}
                            <div x-show="password.length > 0" x-transition class="mt-2">
                                <div class="flex gap-1 mb-1.5">
                                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300"
                                         :class="strength >= 1 ? (strength <= 1 ? 'bg-red-500' : strength <= 2 ? 'bg-gold-500' : strength <= 3 ? 'bg-blue-500' : 'bg-primary-500') : 'bg-dark-700'">
                                    </div>
                                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300"
                                         :class="strength >= 2 ? (strength <= 2 ? 'bg-gold-500' : strength <= 3 ? 'bg-blue-500' : 'bg-primary-500') : 'bg-dark-700'">
                                    </div>
                                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300"
                                         :class="strength >= 3 ? (strength <= 3 ? 'bg-blue-500' : 'bg-primary-500') : 'bg-dark-700'">
                                    </div>
                                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300"
                                         :class="strength >= 4 ? 'bg-primary-500' : 'bg-dark-700'">
                                    </div>
                                </div>
                                <p class="text-xs font-medium"
                                   :class="strength <= 1 ? 'text-red-400' : strength <= 2 ? 'text-gold-400' : strength <= 3 ? 'text-blue-400' : 'text-primary-400'">
                                    <span x-text="strength <= 1 ? '🔴 Weak password' : strength <= 2 ? '🟡 Fair password' : strength <= 3 ? '🔵 Good password' : '🟢 Strong password'"></span>
                                </p>
                            </div>

                            @error('password')
                                <p class="input-error mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm New Password --}}
                        <div class="mb-7">
                            <label class="input-label">
                                Confirm Password <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-dark-400 pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <input
                                    :type="showConfirm ? 'text' : 'password'"
                                    name="password_confirmation"
                                    placeholder="Re-enter your password"
                                    required
                                    autocomplete="new-password"
                                    class="input-field pl-12 pr-12"
                                >
                                <button
                                    type="button"
                                    @click="showConfirm = !showConfirm"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-dark-400 hover:text-white transition-colors"
                                >
                                    <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full py-4 rounded-xl font-bold text-base flex items-center justify-center gap-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-glow-green hover:from-primary-400 hover:to-primary-500 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-70 disabled:cursor-not-allowed disabled:translate-y-0"
                        >
                            <template x-if="!loading">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                    Reset Password
                                </span>
                            </template>
                            <template x-if="loading">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Resetting...
                                </span>
                            </template>
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="flex items-center gap-4 my-6">
                        <div class="flex-1 h-px bg-dark-800"></div>
                        <span class="text-dark-600 text-xs">OR</span>
                        <div class="flex-1 h-px bg-dark-800"></div>
                    </div>

                    {{-- Back to Login --}}
                    <a href="{{ route('login') }}"
                       class="w-full flex items-center justify-center gap-2 py-3 rounded-xl border border-dark-700 text-dark-300 hover:text-white hover:bg-dark-800 hover:border-dark-600 transition-all duration-300 font-semibold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Login
                    </a>
                </div>

                {{-- Back to Home --}}
                <div class="text-center mt-5">
                    <a href="{{ route('home') }}" class="text-dark-500 hover:text-dark-300 text-sm transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Meeqat.io
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>