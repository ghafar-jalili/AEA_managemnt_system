<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto mb-16" data-animate="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-blue-400 text-sm font-medium border border-white/10 mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Contact Us') }}
                </div>
                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4 tracking-tight">
                    {{ __('Get in') }} 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Touch') }}</span>
                </h1>
                <p class="text-lg text-slate-400">
                    {{ __('Have questions about our courses or need assistance? We are here to help!') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                <!-- Contact Information -->
                <div data-animate="fade-up" class="h-full">
                    <div class="bg-gradient-to-br from-blue-600/20 to-purple-600/20 backdrop-blur-xl rounded-2xl border border-white/10 p-8 text-white h-full flex flex-col hover:border-white/20 transition-all duration-500">
                        <h3 class="text-2xl font-bold mb-2">{{ __('Contact Information') }}</h3>
                        <p class="text-slate-400 mb-8">{{ __('Reach out to us through any of these channels') }}</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1 text-white">{{ __('Email') }}</h4>
                                    <p class="text-slate-400">info@aea.org.af</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1 text-white">{{ __('Phone') }}</h4>
                                    <p class="text-slate-400">0778832596</p>
                                    <p class="text-slate-400">0798931328</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-purple-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1 text-white">{{ __('Address') }}</h4>
                                    <p class="text-slate-400">Kabul, Kote-Sangi<br>Third Road of Silo Charahi<br>Qambar Car Station</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center flex-shrink-0 border border-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-1 text-white">{{ __('Office Hours') }}</h4>
                                    <p class="text-slate-400">{{ __('Monday - Thursday') }}: 9:00 AM - 6:00 PM<br>{{ __('Saturday') }}: 10:00 AM - 4:00 PM<br><span class="text-amber-400 font-semibold">{{ __('Friday') }}: {{ __('Closed') }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div data-animate="fade-up" data-animate-delay="100" class="h-full">
                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 p-8 h-full flex flex-col hover:border-white/20 transition-all duration-500">
                        <h3 class="text-2xl font-bold text-white mb-2">{{ __('Send us a Message') }}</h3>
                        <p class="text-slate-400 mb-6">{{ __('Fill out the form below and we will get back to you as soon as possible.') }}</p>
                        <form method="POST" action="{{ route('contact.submit') }}">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Full Name') }}</label>
                                    <input type="text" id="name" name="name" required 
                                           class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email Address') }}</label>
                                    <input type="email" id="email" name="email" required 
                                           class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="subject" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Subject') }}</label>
                                <input type="text" id="subject" name="subject" required 
                                       class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Message') }}</label>
                                <textarea id="message" name="message" rows="5" required 
                                          class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold text-lg hover:-translate-y-0.5 duration-300">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    {{ __('Send Message') }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-10" data-animate="fade-up" data-animate-delay="150">
                <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden hover:border-white/20 transition-all duration-500">
                    <div class="p-8 border-b border-white/10">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center border border-amber-500/30">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">{{ __('Find Us') }}</h3>
                                <p class="text-slate-400">{{ __('Kabul, Kote-Sangi — Third Road of Silo Charahi, Qambar Car Station') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <iframe
                            title="AEA Location"
                            class="w-full h-[420px]"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=Kabul%2C%20Kote-Sangi%2C%20Third%20Road%20of%20Silo%20Charahi%2C%20Qambar%20Car%20Station&output=embed">
                        </iframe>
                        <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-400">{{ __('Open in Google Maps for directions.') }}</p>
                        <a href="https://maps.app.goo.gl/QSstm6MeerxFEsaK6" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white hover:bg-white/10 hover:border-white/20 transition-all">
                            <span class="text-sm font-semibold">{{ __('Open Map') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7m0-7L10 14"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14h14"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
