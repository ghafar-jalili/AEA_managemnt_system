<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-slate-950 py-12 px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'login' }">
        {{-- Animated Background --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-slate-800/20 rounded-full blur-[150px]"></div>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10" data-animate="fade-up">
            <!-- Logo & Header -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 mb-4 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl blur-lg opacity-50"></div>
                    <img src="{{ asset('images/aea-logo.png') }}" alt="AEA Logo" class="relative h-full w-full object-contain rounded-2xl bg-slate-900/50 p-2 border border-white/10">
                </div>
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 mb-2">
                    {{ __('Welcome!') }}
                </h2>
                <p class="text-slate-400 text-sm">{{ __('Sign in or create an account to continue') }}</p>
            </div>

            <!-- Form Card with Tabs -->
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl shadow-[0_0_60px_rgba(0,0,0,0.5)] border border-white/10 overflow-hidden">
                <!-- Tab Navigation -->
                <div class="flex border-b border-white/10">
                    <button @click="activeTab = 'login'" 
                            :class="{ 'bg-white/10 text-white border-b-2 border-blue-500': activeTab === 'login', 'text-slate-400 hover:text-white hover:bg-white/5': activeTab !== 'login' }"
                            class="flex-1 py-4 text-sm font-semibold transition-all duration-300">
                        {{ __('Login') }}
                    </button>
                    <button @click="activeTab = 'register'" 
                            :class="{ 'bg-white/10 text-white border-b-2 border-emerald-500': activeTab === 'register', 'text-slate-400 hover:text-white hover:bg-white/5': activeTab !== 'register' }"
                            class="flex-1 py-4 text-sm font-semibold transition-all duration-300">
                        {{ __('Create Account') }}
                    </button>
                </div>

                <div class="p-8">
                    <!-- Login Form -->
                    <div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-[-20px]" x-transition:enter-end="opacity-100 translate-x-0">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="login-email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
                                <input id="login-email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                                    class="w-full px-4 py-3 !bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none"
                                    placeholder="your@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-sm" />
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="login-password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Password') }}</label>
                                <div class="relative">
                                    <input id="login-password" type="password" name="password" required autocomplete="current-password" 
                                        class="w-full px-4 py-3 pr-12 !bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none"
                                        placeholder="••••••••">
                                    <button type="button" onclick="togglePassword('login-password', this)" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors">
                                        <svg class="h-5 w-5 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg class="h-5 w-5 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-sm" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                    <input id="remember_me" type="checkbox" 
                                        class="rounded border-white/20 bg-slate-900/50 text-blue-500 focus:ring-blue-500/20 cursor-pointer" 
                                        name="remember">
                                    <span class="ms-2 text-sm text-slate-400">{{ __('Remember me') }}</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm font-medium text-blue-400 hover:text-purple-400 transition-colors" 
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] focus:outline-none focus:ring-2 focus:ring-blue-500/20 transform hover:scale-[1.02] transition-all duration-300">
                                {{ __('Sign In') }}
                            </button>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div x-show="activeTab === 'register'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-[20px]" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf

                            <!-- Name -->
                            <div>
                                <label for="register-name" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Full Name') }}</label>
                                <input id="register-name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                                    placeholder="John Doe">
                                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-sm" />
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label for="register-email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
                                <input id="register-email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                                    class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                                    placeholder="your@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-sm" />
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="register-password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Password') }}</label>
                                <div class="relative">
                                    <input id="register-password" type="password" name="password" required autocomplete="new-password" 
                                        class="w-full px-4 py-3 pr-12 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                                        placeholder="••••••••">
                                    <button type="button" onclick="togglePassword('register-password', this)" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors">
                                        <svg class="h-5 w-5 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg class="h-5 w-5 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-sm" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Confirm Password') }}</label>
                                <div class="relative">
                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                                        class="w-full px-4 py-3 pr-12 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                                        placeholder="••••••••">
                                    <button type="button" onclick="togglePassword('password_confirmation', this)" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition-colors">
                                        <svg class="h-5 w-5 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg class="h-5 w-5 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400 text-sm" />
                            </div>

                            <!-- Register Button -->
                            <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-emerald-600 to-blue-600 hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transform hover:scale-[1.02] transition-all duration-300">
                                {{ __('Create Account') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-xs text-slate-500">
                    © {{ date('Y') }} AFG Engineering Association. {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const eyeOpen = button.querySelector('.eye-open');
            const eyeClosed = button.querySelector('.eye-closed');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>
