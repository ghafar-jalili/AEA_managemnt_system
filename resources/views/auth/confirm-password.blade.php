<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-slate-950 py-12 px-4 sm:px-6 lg:px-8">
        {{-- Animated Background --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10" data-animate="fade-up">
            <!-- Logo & Header -->
            <div class="text-center">
                <div class="mx-auto h-20 w-20 mb-4 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl blur-lg opacity-50"></div>
                    <img src="{{ asset('images/aea-logo.png') }}" alt="AEA Logo" class="relative h-full w-full object-contain rounded-2xl bg-slate-900/50 p-2 border border-white/10">
                </div>
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 mb-2">
                    {{ __('Confirm Password') }}
                </h2>
            </div>

            <!-- Form Card -->
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl shadow-[0_0_60px_rgba(0,0,0,0.5)] p-8 border border-white/10">
                <div class="mb-6 text-sm text-slate-400">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transform hover:scale-[1.02] transition-all duration-300">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-xs text-slate-500">
                    © {{ date('Y') }} AFG Engineering Association. {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
