@php
    $dashboardRoute = null;
    $dashboardActive = false;
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            $dashboardRoute = route('admin.dashboard');
            $dashboardActive = request()->routeIs('admin.*');
        } elseif (auth()->user()->isTeacher()) {
            $dashboardRoute = route('teacher.dashboard');
            $dashboardActive = request()->routeIs('teacher.*');
        } else {
            $dashboardRoute = route('student.dashboard');
            $dashboardActive = request()->routeIs('student.*');
        }
    }
    
    $publicNavItems = [
        ['route' => 'home', 'label' => 'Home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['route' => 'courses.public.index', 'label' => 'Courses', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['route' => 'about', 'label' => 'About', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['url' => '/equipment', 'label' => 'Equipment', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
        ['route' => 'contact', 'label' => 'Contact', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
    ];

    $authNavItems = [
        ['route' => 'certificate.search', 'label' => 'Certificates', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.587 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.587 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.587 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.587 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
    ];

    $navItems = $publicNavItems;
    if (auth()->check()) {
        $navItems = array_merge($publicNavItems, $authNavItems);
    }
@endphp

<nav x-data="{ mobileOpen: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 50)"
     :class="{ 'bg-slate-950/90 backdrop-blur-xl border-white/10 shadow-[0_4px_30px_rgba(0,0,0,0.5)]': scrolled, 'bg-transparent border-transparent': !scrolled }"
     class="fixed  top-0 left-0 right-0 z-[9997] transition-all duration-500 border-b">
    
    <div class=" container-premium">
        <div class="flex  justify-between items-center h-16 lg:h-20">
            {{-- Logo --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/aea-logo.png') }}" alt="AEA Logo" class="w-12 h-12 object-contain rounded-lg bg-white/10 p-1 border border-white/10 group-hover:border-white/20 transition-all">
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">AEA</span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-1">
                    @foreach($navItems as $item)
                        @if(isset($item['route']))
                            <a href="{{ route($item['route']) }}" 
                               class="nav-link px-4 py-2 text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2
                               {{ request()->routeIs($item['route'] . (str_contains($item['route'], '.*') ? '' : '.*')) ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                                {{ __($item['label']) }}
                            </a>
                        @else
                            <a href="{{ url($item['url']) }}" 
                               class="nav-link px-4 py-2 text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2
                               {{ request()->is(trim($item['url'], '/')) ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                                {{ __($item['label']) }}
                            </a>
                        @endif
                    @endforeach

                    @auth
                        @if(! Auth::user()->isAdmin())
                            <a href="{{ route('course-request.form') }}" 
                               class="nav-link px-4 py-2 text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2
                               {{ request()->is('request-course') ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Request Course') }}
                            </a>
                        @endif
                    @endauth

                    @if($dashboardRoute)
                        <a href="{{ $dashboardRoute }}" 
                           class="nav-link px-4 py-2 text-sm font-medium rounded-xl transition-all duration-200 flex items-center gap-2
                           {{ $dashboardActive ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right Side Actions --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        {{-- Notification Bell --}}
                        @php
                            $totalNotifications = array_sum($notifications ?? []);
                        @endphp
                        <a href="{{ route('admin.dashboard') }}" class="relative p-2 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-200 border border-transparent hover:border-white/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            @if($totalNotifications > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30">
                                    {{ $totalNotifications > 9 ? '9+' : $totalNotifications }}
                                </span>
                            @endif
                        </a>
                    @endif

                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ userDropdownOpen: false }" @click.outside="userDropdownOpen = false">
                        <button @click="userDropdownOpen = !userDropdownOpen" class="flex items-center gap-3 p-1.5 pr-4 rounded-xl hover:bg-white/5 transition-all duration-200 border border-transparent hover:border-white/10">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-slate-300">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-slate-500 transition-transform" :class="{ 'rotate-180': userDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 top-full mt-2 w-56 bg-slate-900/95 backdrop-blur-xl rounded-xl shadow-2xl border border-white/10 py-2 z-50 origin-top-right">
                            <div class="px-4 py-3 border-b border-white/10">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition-colors text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-300 hover:shadow-blue-500/40 hover:scale-[1.02] flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        {{ __('Get Started') }}
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex items-center lg:hidden gap-2">
                <button @click="mobileOpen = !mobileOpen" class="p-2 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-200 border border-white/10">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-slate-950/98 backdrop-blur-xl border-t border-white/10"
         style="display: none;">
        <div class="container-premium py-4 space-y-1">
                @foreach($navItems as $item)
                @if(isset($item['route']))
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                       {{ request()->routeIs($item['route'] . (str_contains($item['route'], '.*') ? '' : '.*')) ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ __($item['label']) }}
                    </a>
                @else
                    <a href="{{ url($item['url']) }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                       {{ request()->is(trim($item['url'], '/')) ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ __($item['label']) }}
                    </a>
                @endif
            @endforeach

            @auth
                @if(! Auth::user()->isAdmin())
                    <a href="{{ route('course-request.form') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                       {{ request()->is('request-course') ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Request Course') }}
                    </a>
                @endif
                
                @if($dashboardRoute)
                    <a href="{{ $dashboardRoute }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                       {{ $dashboardActive ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        {{ __('Dashboard') }}
                    </a>
                @endif

                <div class="border-t border-white/10 my-2 pt-2">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 text-sm font-medium text-red-400 hover:bg-red-500/10 rounded-xl py-2 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-white/10 my-2 pt-4 space-y-2">
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        {{ __('Get Started') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
