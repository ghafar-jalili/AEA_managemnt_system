<footer class="mt-auto relative bg-slate-950 text-slate-400 overflow-hidden">
    {{-- Background Effects --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-0 right-1/4 w-[400px] h-[400px] bg-purple-600/5 rounded-full blur-[120px]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.01)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.01)_1px,transparent_1px)] bg-[size:60px_60px] [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
    </div>

    {{-- Newsletter Section --}}
    <div class="relative border-b border-white/10">
        <div class="container-premium py-16">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="text-center lg:text-left">
                    <h3 class="text-3xl font-bold text-white mb-3 tracking-tight">{{ __('Stay Updated') }}</h3>
                    <p class="text-slate-400">{{ __('Get the latest courses and updates delivered to your inbox.') }}</p>
                </div>
                <form class="flex flex-col sm:flex-row gap-3 w-full max-w-md">
                    <div class="relative flex-1">
                        <input type="email" placeholder="{{ __('Enter your email') }}" 
                               class="w-full px-5 py-3.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 backdrop-blur-sm">
                    </div>
                    <button type="submit" class="group relative inline-flex items-center gap-2 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:scale-[1.02] whitespace-nowrap">
                        <span class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative">{{ __('Subscribe') }}</span>
                        <svg class="relative w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Footer Content --}}
    <div class="container-premium relative z-10 py-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-12">
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6 group">
                    <img src="{{ asset('images/aea-logo.png') }}" alt="AEA Logo" class="w-14 h-14 object-contain rounded-xl bg-white/5 p-1.5 border border-white/10 group-hover:border-white/20 transition-all">
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">AEA</span>
                </a>
                <p class="text-slate-400 mb-6 leading-relaxed">
                    {{ __('Empowering engineers with practical training, expert-led courses, and industry-recognized certifications.') }}
                </p>
                <div class="flex gap-3">
                    <a href="https://t.me/AEA34" target="_blank" rel="noopener" class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-sky-500/20 hover:text-sky-400 hover:border-sky-500/30 transition-all duration-300" aria-label="Telegram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.5 3.5c-.3-.3-.8-.4-1.3-.2L2.7 10.3c-.6.2-1 .8-.9 1.4.1.6.6 1 1.2 1.1l4.9.9 1.9 5.8c.2.6.7 1 1.3 1h.1c.5 0 1-.3 1.3-.7l2.7-3.6 5.3 3.9c.2.1.5.2.8.2.2 0 .4 0 .6-.1.5-.2.8-.6.9-1.1l2.8-15.9c.1-.4 0-.9-.3-1.2zM9.1 13.2l9.8-6.2-7.9 7.5-.3 4.2-1.7-5.2c0-.2 0-.2.1-.3z"/></svg>
                    </a>
                    <a href="https://whatsapp.com/channel/0029VabTk2a4IBh5wam50U1J" target="_blank" rel="noopener" class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 hover:border-emerald-500/30 transition-all duration-300" aria-label="WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.86 11.86 0 0012.02 0C5.41 0 .07 5.33.07 11.93c0 2.1.55 4.15 1.6 5.96L0 24l6.27-1.64a11.9 11.9 0 005.75 1.47h.01c6.61 0 11.95-5.33 11.95-11.93 0-3.19-1.25-6.19-3.46-8.42zM12.02 21.8h-.01a9.9 9.9 0 01-5.05-1.39l-.36-.21-3.72.97.99-3.63-.23-.38a9.86 9.86 0 01-1.53-5.23c0-5.49 4.47-9.95 9.96-9.95a9.9 9.9 0 017.07 2.93 9.9 9.9 0 012.92 7.02c0 5.49-4.47 9.87-10.04 9.87zm5.77-7.36c-.31-.16-1.86-.92-2.15-1.03-.29-.11-.5-.16-.71.16-.21.31-.82 1.03-1 1.24-.18.21-.37.24-.68.08-.31-.16-1.31-.48-2.49-1.53-.92-.82-1.54-1.84-1.72-2.15-.18-.31-.02-.48.14-.64.14-.14.31-.37.47-.55.16-.18.21-.31.31-.52.1-.21.05-.39-.03-.55-.08-.16-.71-1.71-.98-2.34-.26-.63-.52-.54-.71-.55h-.61c-.21 0-.55.08-.84.39-.29.31-1.1 1.08-1.1 2.62 0 1.55 1.13 3.04 1.29 3.25.16.21 2.22 3.39 5.38 4.75.75.32 1.34.51 1.8.65.76.24 1.45.21 2 .13.61-.09 1.86-.76 2.12-1.49.26-.73.26-1.36.18-1.49-.08-.13-.29-.21-.6-.37z"/></svg>
                    </a>
                    <a href="mailto:aea.afghanistan@gmail.com" class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-amber-500/20 hover:text-amber-400 hover:border-amber-500/30 transition-all duration-300" aria-label="Email">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/share/1EF6iSLzRw/" target="_blank" rel="noopener" class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-blue-500/20 hover:text-blue-400 hover:border-blue-500/30 transition-all duration-300" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.326 24h11.495v-9.294H9.692v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Explore Links --}}
            <div>
                <h4 class="text-white font-semibold mb-6 text-lg">{{ __('Explore') }}</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-blue-500 transition-colors"></span>
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('courses.public.index') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-blue-500 transition-colors"></span>
                            {{ __('Courses') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('certificate.search') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-blue-500 transition-colors"></span>
                            {{ __('Verify Certificate') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('equipment') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-blue-500 transition-colors"></span>
                            {{ __('Equipment') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Company Links --}}
            <div>
                <h4 class="text-white font-semibold mb-6 text-lg">{{ __('Company') }}</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('about') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-purple-500 transition-colors"></span>
                            {{ __('About Us') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-purple-500 transition-colors"></span>
                            {{ __('Contact') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-purple-500 transition-colors"></span>
                            {{ __('Careers') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-purple-500 transition-colors"></span>
                            {{ __('Blog') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Support Links --}}
            <div>
                <h4 class="text-white font-semibold mb-6 text-lg">{{ __('Support') }}</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-pink-500 transition-colors"></span>
                            {{ __('Help Center') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-pink-500 transition-colors"></span>
                            {{ __('Privacy Policy') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-pink-500 transition-colors"></span>
                            {{ __('Terms of Service') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-pink-500 transition-colors"></span>
                            {{ __('FAQ') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-20 pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-slate-500">
                &copy; {{ date('Y') }} AEA - Afghanistan Engineers Association. {{ __('All rights reserved.') }}
            </p>
            <div class="flex items-center gap-6 text-sm text-slate-500">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ __('Built for learners & builders') }}
                </span>
            </div>
        </div>
    </div>
</footer>
