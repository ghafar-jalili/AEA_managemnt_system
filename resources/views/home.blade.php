<x-app-layout>
    {{-- Immersive Hero Section --}}
    <section class="relative min-h-screen flex items-center overflow-hidden" id="heroSection">
        {{-- Animated Background --}}
        <div class="absolute inset-0 bg-slate-950">
            {{-- Gradient Orbs --}}
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[120px] animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-[100px] animate-pulse" style="animation-duration: 10s; animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-600/10 rounded-full blur-[150px] animate-pulse" style="animation-duration: 12s; animation-delay: 4s;"></div>
            
            {{-- Grid Pattern --}}
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:60px_60px] [mask-image:radial-gradient(ellipse_at_center,black,transparent_70%)]"></div>
            
            {{-- Floating Particles --}}
            <div class="absolute inset-0 overflow-hidden" id="particlesContainer">
                <div class="particle absolute w-2 h-2 bg-blue-500/30 rounded-full" style="top: 20%; left: 10%;"></div>
                <div class="particle absolute w-1 h-1 bg-purple-500/40 rounded-full" style="top: 60%; left: 20%;"></div>
                <div class="particle absolute w-3 h-3 bg-indigo-500/20 rounded-full" style="top: 40%; left: 80%;"></div>
                <div class="particle absolute w-1 h-1 bg-cyan-500/30 rounded-full" style="top: 80%; left: 60%;"></div>
                <div class="particle absolute w-2 h-2 bg-violet-500/25 rounded-full" style="top: 30%; left: 70%;"></div>
            </div>
        </div>
        
        <div class="container-premium relative z-10 py-24 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                {{-- Left Content --}}
                <div class="space-y-8 hero-content">
                    {{-- Badge --}}
                    <div class="hero-badge inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-white/80 text-sm font-medium border border-white/10 hover:border-white/20 transition-colors cursor-pointer group">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span>{{ __('New courses available') }}</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity -translate-x-2 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                    
                    {{-- Main Heading with Split Text Animation --}}
                    <h1 class="hero-title text-5xl lg:text-7xl xl:text-8xl font-bold text-white leading-[1.1] tracking-tight">
                        <span class="block overflow-hidden">
                            <span class="inline-block">{{ __('Afghanistan') }}</span>
                        </span>
                        <span class="block overflow-hidden">
                            <span class="inline-block">{{ __('Engineers') }}</span>
                        </span>
                        <span class="block overflow-hidden">
                            <span class="inline-block text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Association') }}</span>
                        </span>
                    </h1>
                    
                    {{-- Description --}}
                    <p class="hero-desc text-lg lg:text-xl text-slate-400 max-w-xl leading-relaxed">
                        {{ __('Join thousands of engineers advancing their careers with expert-led courses, hands-on projects, and industry-recognized certifications.') }}
                    </p>
                    
                    {{-- CTAs --}}
                    <div class="hero-cta flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('courses.public.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] hover:scale-[1.02]">
                            <span class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            <svg class="relative w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="relative">{{ __('Explore Courses') }}</span>
                        </a>
                        <a href="{{ route('about') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/5 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Learn More') }}
                        </a>
                    </div>
                    
                    {{-- Stats --}}
                    <div class="hero-stats flex flex-wrap gap-8 pt-8 border-t border-white/10">
                        <div class="stat-item">
                            <p class="stat-number text-4xl lg:text-5xl font-bold text-white" data-counter="50">0</p>
                            <p class="text-sm text-slate-400 mt-1">{{ __('Expert Courses') }}</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number text-4xl lg:text-5xl font-bold text-white" data-counter="10" data-suffix="K+">0</p>
                            <p class="text-sm text-slate-400 mt-1">{{ __('Students') }}</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-number text-4xl lg:text-5xl font-bold text-white" data-counter="95" data-suffix="%">0</p>
                            <p class="text-sm text-slate-400 mt-1">{{ __('Success Rate') }}</p>
                        </div>
                    </div>
                </div>
                
                {{-- Right Content - 3D Visual --}}
                <div class="hidden lg:block relative hero-visual">
                    {{-- Main 3D Card --}}
                    <div class="relative w-full aspect-square max-w-lg mx-auto">
                        {{-- Rotating Rings --}}
                        <div class="absolute inset-0 border border-white/5 rounded-full animate-[spin_20s_linear_infinite]"></div>
                        <div class="absolute inset-4 border border-white/5 rounded-full animate-[spin_15s_linear_infinite_reverse]"></div>
                        <div class="absolute inset-8 border border-blue-500/10 rounded-full animate-[spin_30s_linear_infinite]"></div>
                        
                        {{-- Central Card --}}
                        <div class="absolute inset-16 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-2xl rounded-3xl border border-white/10 flex items-center justify-center overflow-hidden group hover:border-white/20 transition-all duration-500">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/aea-logo.png') }}" alt="AEA" class="w-32 h-32 object-contain relative z-10 drop-shadow-2xl">
                        </div>
                        
                        {{-- Floating Elements --}}
                        <div class="absolute -top-4 -right-4 bg-white/10 backdrop-blur-xl rounded-2xl p-4 border border-white/10 float-animation" style="animation-delay: 0s;">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/20 flex items-center justify-center border border-emerald-500/30">
                                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ __('Certified') }}</p>
                                    <p class="text-xs text-slate-400">{{ __('Industry recognized') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-4 -left-4 bg-white/10 backdrop-blur-xl rounded-2xl p-4 border border-white/10 float-animation" style="animation-delay: 1s;">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-600/20 flex items-center justify-center border border-blue-500/30">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ __('Self-paced') }}</p>
                                    <p class="text-xs text-slate-400">{{ __('Learn anytime') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute top-1/2 -right-8 bg-white/10 backdrop-blur-xl rounded-2xl p-4 border border-white/10 float-animation" style="animation-delay: 2s;">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 flex items-center justify-center border border-purple-500/30">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ __('Community') }}</p>
                                    <p class="text-xs text-slate-400">{{ __('Join 10k+ members') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 scroll-indicator">
            <div class="w-6 h-10 border-2 border-white/20 rounded-full flex justify-center">
                <div class="w-1.5 h-3 bg-white/60 rounded-full mt-2 animate-bounce"></div>
            </div>
        </div>
    </section>

    {{-- Features Section - Glassmorphism Cards --}}
    <section class="relative py-32 overflow-hidden" id="featuresSection">
        {{-- Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2"></div>
            <div class="absolute top-1/2 right-0 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[100px] -translate-y-1/2"></div>
        </div>
        
        <div class="container-premium relative z-10">
            {{-- Section Header --}}
            <div class="text-center max-w-3xl mx-auto mb-20 features-header">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-blue-400 text-sm font-medium border border-white/10 mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    {{ __('Why Choose Us') }}
                </div>
                <h2 class="text-4xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                    {{ __('Everything You Need to') }} 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Succeed') }}</span>
                </h2>
                <p class="text-lg text-slate-400">
                    {{ __('Comprehensive learning platform designed for modern engineers') }}
                </p>
            </div>
            
            {{-- Features Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Feature 1 --}}
                <div class="feature-card group relative p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(59,130,246,0.2)] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-600/20 flex items-center justify-center border border-blue-500/30 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors">{{ __('Expert-Led Courses') }}</h3>
                        <p class="text-slate-400 leading-relaxed">
                            {{ __('Learn from industry professionals with years of real-world experience in engineering and technology.') }}
                        </p>
                    </div>
                </div>
                
                {{-- Feature 2 --}}
                <div class="feature-card group relative p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(16,185,129,0.2)] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/10 to-teal-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/20 flex items-center justify-center border border-emerald-500/30 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">{{ __('Verified Certificates') }}</h3>
                        <p class="text-slate-400 leading-relaxed">
                            {{ __('Earn industry-recognized credentials that validate your skills and boost your career prospects.') }}
                        </p>
                    </div>
                </div>
                
                {{-- Feature 3 --}}
                <div class="feature-card group relative p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(139,92,246,0.2)] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-violet-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 flex items-center justify-center border border-purple-500/30 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors">{{ __('Flexible Learning') }}</h3>
                        <p class="text-slate-400 leading-relaxed">
                            {{ __('Study at your own pace with lifetime access to course materials and updates.') }}
                        </p>
                    </div>
                </div>
                
                {{-- Feature 4 --}}
                <div class="feature-card group relative p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(245,158,11,0.2)] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-600/10 to-orange-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500/20 to-amber-600/20 flex items-center justify-center border border-amber-500/30 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-amber-400 transition-colors">{{ __('Community Support') }}</h3>
                        <p class="text-slate-400 leading-relaxed">
                            {{ __('Join a vibrant community of learners and professionals to network and collaborate.') }}
                        </p>
                    </div>
                </div>
                
                {{-- Feature 5 --}}
                <div class="feature-card group relative p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(236,72,153,0.2)] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-600/10 to-rose-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-pink-500/20 to-pink-600/20 flex items-center justify-center border border-pink-500/30 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-pink-400 transition-colors">{{ __('Hands-on Projects') }}</h3>
                        <p class="text-slate-400 leading-relaxed">
                            {{ __('Apply what you learn through practical projects that build your portfolio.') }}
                        </p>
                    </div>
                </div>
                
                {{-- Feature 6 --}}
                <div class="feature-card group relative p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(6,182,212,0.2)] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-600/10 to-sky-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500/20 to-cyan-600/20 flex items-center justify-center border border-cyan-500/30 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-cyan-400 transition-colors">{{ __('Equipment Access') }}</h3>
                        <p class="text-slate-400 leading-relaxed">
                            {{ __('Rent professional engineering equipment for your projects and experiments.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Courses Section - Premium Dark --}}
    @if(isset($featuredCourses) && $featuredCourses->count() > 0)
    <section class="relative py-32 overflow-hidden" id="coursesSection">
        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950">
            <div class="absolute top-0 left-1/3 w-[600px] h-[600px] bg-purple-600/10 rounded-full blur-[150px]"></div>
            <div class="absolute bottom-0 right-1/3 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            {{-- Section Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 courses-header">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-purple-400 text-sm font-medium border border-white/10 mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        {{ __('Featured Courses') }}
                    </div>
                    <h2 class="text-4xl lg:text-6xl font-bold text-white tracking-tight">
                        {{ __('Start Learning') }} 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400">{{ __('Today') }}</span>
                    </h2>
                </div>
                <a href="{{ route('courses.public.index') }}" class="group inline-flex items-center gap-2 px-6 py-3 bg-white/5 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300">
                    {{ __('View All Courses') }}
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            {{-- Courses Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredCourses as $index => $course)
                <div class="course-card group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(139,92,246,0.15)]">
                    {{-- Course Image --}}
                    <div class="relative aspect-video overflow-hidden">
                        @if($course->thumbnail)
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-600/20 to-purple-600/20 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                        
                        {{-- Featured Badge --}}
                        @if($course->is_featured)
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-semibold rounded-full">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ __('Featured') }}
                                </span>
                            </div>
                        @endif
                        
                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <a href="{{ route('courses.public.show', $course) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)]">
                                {{ __('View Course') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    {{-- Course Content --}}
                    <div class="p-6 relative">
                        <div class="flex items-center gap-2 mb-3">
                            @if($course->category)
                                <span class="px-2 py-1 bg-blue-500/10 text-blue-400 text-xs font-medium rounded-lg border border-blue-500/20">{{ $course->category }}</span>
                            @endif
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-white/5 text-slate-400 text-xs font-medium rounded-lg border border-white/10">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/>
                                </svg>
                                {{ $course->duration ?? '8 weeks' }}
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-blue-400 transition-colors line-clamp-1">
                            {{ $course->title }}
                        </h3>
                        <p class="text-slate-400 text-sm line-clamp-2 mb-4">
                            {{ Str::limit($course->description, 120) }}
                        </p>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($course->teacher->name ?? 'AFG', 0, 1) }}
                                </div>
                                <span class="text-sm text-slate-400">{{ $course->teacher->name ?? 'AEA Team' }}</span>
                            </div>
                            <span class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                @if($course->price > 0)
                                    {{ number_format($course->price, 2) }} AF
                                @else
                                    {{ __('Free') }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section - Premium Dark --}}
    <section class="relative py-32 overflow-hidden" id="ctaSection">
        {{-- Animated Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-purple-600/20 to-pink-600/20"></div>
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[150px] animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-[120px] animate-pulse" style="animation-duration: 10s; animation-delay: 2s;"></div>
        </div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:80px_80px] [mask-image:radial-gradient(ellipse_at_center,black,transparent_70%)]"></div>
        
        <div class="container-premium relative z-10">
            <div class="max-w-4xl mx-auto text-center cta-content">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-emerald-400 text-sm font-medium border border-white/10 mb-8">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    {{ __('Join 10,000+ Engineers') }}
                </div>
                
                <h2 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 tracking-tight leading-tight">
                    {{ __('Ready to Start') }}
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Your Journey?') }}</span>
                </h2>
                <p class="text-lg md:text-xl text-slate-400 mb-12 max-w-2xl mx-auto">
                    {{ __('Join thousands of engineers who have transformed their careers with AEA. Access expert-led courses, earn industry-recognized certificates, and connect with a global community.') }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-[0_0_60px_rgba(139,92,246,0.5)] hover:scale-[1.02]">
                        <span class="absolute inset-0 bg-gradient-to-r from-pink-600 via-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                        <span class="relative">{{ __('Get Started Free') }}</span>
                        <svg class="relative w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="{{ route('courses.public.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/5 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300">
                        {{ __('Explore Courses') }}
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                
                {{-- Trust Indicators --}}
                <div class="mt-16 pt-8 border-t border-white/10">
                    <div class="flex flex-wrap justify-center gap-8 text-slate-500 text-sm">
                        <div class="flex font-bold items-center gap-2">
                            <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                            </svg>
                            {{ __('No credit card required') }}
                        </div>
                        <div class="flex font-bold items-center gap-2">
                            <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                            </svg>
                            {{ __('Free courses available') }}
                        </div>
                        <div class="flex items-center font-bold gap-2">
                            <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                            </svg>
                            {{ __('Cancel anytime') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- GSAP Animations Script --}}
    @push('scripts')
    <script>
        // Initialize Lenis Smooth Scroll
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            orientation: 'vertical',
            gestureOrientation: 'vertical',
            smoothWheel: true,
            wheelMultiplier: 1,
            touchMultiplier: 2,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Sync GSAP ScrollTrigger with Lenis
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);

        // Scroll Progress Indicator
        gsap.to('#scrollProgress', {
            scaleX: 1,
            ease: 'none',
            scrollTrigger: {
                trigger: 'body',
                start: 'top top',
                end: 'bottom bottom',
                scrub: 0.3,
            }
        });

        // Page Loader Animation
        window.addEventListener('load', () => {
            const loader = document.getElementById('pageLoader');
            
            gsap.to(loader, {
                opacity: 0,
                duration: 0.8,
                ease: 'power2.out',
                onComplete: () => {
                    loader.classList.add('hidden');
                    document.body.classList.add('loaded');
                    initHeroAnimations();
                }
            });
        });

        // Hero Animations
        function initHeroAnimations() {
            const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

            // Badge animation
            tl.from('.hero-badge', {
                y: 30,
                opacity: 0,
                duration: 0.8,
            })
            // Title words animation
            .from('.hero-title span span', {
                y: 100,
                opacity: 0,
                duration: 1,
                stagger: 0.15,
            }, '-=0.4')
            // Description
            .from('.hero-desc', {
                y: 30,
                opacity: 0,
                duration: 0.8,
            }, '-=0.6')
            // CTA buttons
            .from('.hero-cta a', {
                y: 30,
                opacity: 0,
                duration: 0.6,
                stagger: 0.1,
            }, '-=0.4')
            // Stats counter animation
            .add(() => {
                animateCounters();
            }, '-=0.2')
            // Visual element
            .from('.hero-visual', {
                scale: 0.8,
                opacity: 0,
                duration: 1.2,
                ease: 'back.out(1.7)',
            }, '-=1');

            // Floating particles animation
            gsap.to('.particle', {
                y: 'random(-20, 20)',
                x: 'random(-10, 10)',
                duration: 'random(3, 6)',
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                stagger: {
                    each: 0.5,
                    from: 'random',
                }
            });
        }

        // Counter Animation
        function animateCounters() {
            document.querySelectorAll('.stat-number').forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const suffix = counter.textContent.includes('K') ? 'K+' : 
                              counter.textContent.includes('%') ? '%' : '+';
                
                gsap.to(counter, {
                    innerText: target,
                    duration: 2,
                    ease: 'power2.out',
                    snap: { innerText: 1 },
                    onUpdate: function() {
                        counter.innerText = Math.round(this.targets()[0].innerText) + suffix;
                    }
                });
            });
        }

        // Features Section Animations
        gsap.from('.features-header', {
            y: 50,
            duration: 1,
            scrollTrigger: {
                trigger: '#featuresSection',
                start: 'top 80%',
                toggleActions: 'play none none reverse',
            }
        });

        gsap.from('.feature-card', {
            y: 60,
            duration: 0.8,
            stagger: 0.1,
            scrollTrigger: {
                trigger: '#featuresSection',
                start: 'top 70%',
                toggleActions: 'play none none reverse',
            }
        });

        // Courses Section Animations
        gsap.from('.courses-header', {
            y: 50,
            duration: 1,
            scrollTrigger: {
                trigger: '#coursesSection',
                start: 'top 80%',
                toggleActions: 'play none none reverse',
            }
        });

        gsap.from('.course-card', {
            y: 80,
            duration: 0.8,
            stagger: 0.15,
            scrollTrigger: {
                trigger: '#coursesSection',
                start: 'top 60%',
                toggleActions: 'play none none reverse',
            }
        });

        // CTA Section Animation
        gsap.from('.cta-content > *', {
            y: 50,
            duration: 0.8,
            stagger: 0.15,
            scrollTrigger: {
                trigger: '#ctaSection',
                start: 'top 70%',
                toggleActions: 'play none none reverse',
            }
        });

        // Scroll Indicator Fade
        gsap.to('.scroll-indicator', {
            opacity: 0,
            scrollTrigger: {
                trigger: '#heroSection',
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            }
        });

        // Parallax Effect for Hero Visual
        gsap.to('.hero-visual', {
            yPercent: 20,
            ease: 'none',
            scrollTrigger: {
                trigger: '#heroSection',
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            }
        });
    </script>
    
    <style>
        /* Float Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 4s ease-in-out infinite;
        }
    </style>
    @endpush
</x-app-layout>
