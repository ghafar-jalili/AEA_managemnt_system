<x-app-layout>
    <section class="relative pt-24 pb-16 overflow-hidden min-h-screen">
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-12" data-animate="fade-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-blue-400 text-sm font-medium border border-white/10 mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Certificate Verification') }}
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4 tracking-tight">
                        {{ __('Verify') }} 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Certificate') }}</span>
                    </h1>
                    <p class="text-lg text-slate-400">
                        {{ __('Enter the certificate number to verify its authenticity') }}
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 p-8 hover:border-white/20 transition-all duration-500" data-animate="fade-up" data-animate-delay="100">
                    @if(session('error'))
                        <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl mb-6">
                            <p class="text-red-400 font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form method="GET" action="{{ url('/certificate/search') }}">
                        <div class="mb-6">
                            <label for="certificate_number" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Certificate Number') }}
                            </label>
                            <input 
                                type="text" 
                                id="certificate_number" 
                                name="certificate_number" 
                                required 
                                autofocus 
                                placeholder="e.g., AFG-20260427-27E1FE"
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                            <p class="mt-2 text-sm text-slate-500">
                                {{ __('You can find your certificate number on your issued certificate document.') }}
                            </p>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] font-semibold transition-all duration-300 hover:-translate-y-0.5">
                            {{ __('Verify Certificate') }}
                        </button>
                    </form>

                    <div class="mt-6 p-4 bg-blue-500/10 rounded-xl border border-blue-500/20">
                        <h4 class="font-semibold text-blue-400 mb-2">{{ __('Note') }}:</h4>
                        <p class="text-sm text-slate-400">
                            {{ __('If you do not have your certificate number, please contact the administration for assistance.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
