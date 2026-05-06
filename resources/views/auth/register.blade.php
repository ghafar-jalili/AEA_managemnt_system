<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-slate-950 py-12 px-4 sm:px-6 lg:px-8">
        {{-- Animated Background --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-emerald-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[100px]"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-slate-800/20 rounded-full blur-[150px]"></div>
        </div>

        <div class="max-w-lg w-full space-y-8 relative z-10" data-animate="fade-up">
            <!-- Logo & Header -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 mb-4 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-blue-500 rounded-2xl blur-lg opacity-50"></div>
                    <img src="{{ asset('images/aea-logo.png') }}" alt="AEA Logo" class="relative h-full w-full object-contain rounded-2xl bg-slate-900/50 p-2 border border-white/10">
                </div>
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-blue-400 to-purple-400 mb-2">
                    {{ __('Create Account') }}
                </h2>
                <p class="text-slate-400 text-sm">{{ __('Join our engineering community') }}</p>
            </div>

            <!-- Register Form Card -->
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl shadow-[0_0_60px_rgba(0,0,0,0.5)] p-10 border border-white/10">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">
                            {{ __('Full Name') }}
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                            placeholder="your@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                            {{ __('Password') }}
                        </label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password" 
                                class="w-full px-4 py-3 pr-12 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all outline-none"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', this)" 
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
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">
                            {{ __('Confirm Password') }}
                        </label>
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
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Register Button -->
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-emerald-600 to-blue-600 hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transform hover:scale-[1.02] transition-all duration-300">
                        {{ __('Create Account') }}
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-slate-900 text-slate-500">{{ __('Already have an account?') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="font-semibold text-emerald-400 hover:text-blue-400 transition-colors">
                        {{ __('Sign In Here') }}
                    </a>
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
