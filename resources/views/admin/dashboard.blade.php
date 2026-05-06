<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">{{ __('Admin Dashboard') }}</h1>
                <p class="text-slate-400 mt-1">{{ __('Welcome back, ') }} {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1.5 bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 rounded-full text-sm font-medium flex items-center gap-2">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ __('Admin Access') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Alert Banner --}}
            @if(isset($coursesReadyToStart) && $coursesReadyToStart->count() > 0)
                <div class="mb-8 flex items-start gap-4 p-4 bg-amber-500/10 border border-amber-500/20 rounded-xl" data-animate="fade-down">
                    <div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center text-amber-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-amber-400 mb-1">{{ __('Courses Ready to Start!') }}</h3>
                        <p class="text-amber-400/70">{{ $coursesReadyToStart->count() }} {{ __('course(s) have 3+ interested students') }}</p>
                    </div>
                    <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                        {{ __('View Courses') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            @endif

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Total Users --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all duration-300" data-animate="fade-up">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">{{ __('Total Users') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $totalUsers ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/25">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-sm text-emerald-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        <span>{{ __('Active users') }}</span>
                    </div>
                </div>

                {{-- Total Courses --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all duration-300" data-animate="fade-up" data-delay="100">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">{{ __('Total Courses') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $totalCourses ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/25">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-sm text-emerald-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        <span>{{ __('Published') }}</span>
                    </div>
                </div>

                {{-- Enrollments --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all duration-300" data-animate="fade-up" data-delay="200">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">{{ __('Enrollments') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $totalEnrollments ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/25">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-sm text-emerald-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        <span>{{ __('Total registrations') }}</span>
                    </div>
                </div>

                {{-- Messages --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all duration-300" data-animate="fade-up" data-delay="300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">{{ __('Unread Messages') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $unreadMessages ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-amber-500/25">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-sm text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <span>{{ __('Need attention') }}</span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <h4 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    {{ __('Quick Actions') }}
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.courses.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all duration-300 relative">
                        @if(($notifications['courses'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['courses'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center text-blue-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-blue-400 transition-colors">{{ __('Manage Courses') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.enrollments.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-emerald-500/50 hover:bg-emerald-500/10 transition-all duration-300 relative">
                        @if(($notifications['enrollments'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['enrollments'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center text-emerald-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-emerald-400 transition-colors">{{ __('Enrollments') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.certificates.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-purple-500/50 hover:bg-purple-500/10 transition-all duration-300 relative">
                        @if(($notifications['certificates'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['certificates'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-purple-500/20 border border-purple-500/30 rounded-xl flex items-center justify-center text-purple-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.587 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.587 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.587 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.587 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-purple-400 transition-colors">{{ __('Certificates') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.contact-messages.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-amber-500/50 hover:bg-amber-500/10 transition-all duration-300 relative">
                        @if(($notifications['messages'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['messages'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-amber-500/20 border border-amber-500/30 rounded-xl flex items-center justify-center text-amber-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-amber-400 transition-colors">{{ __('Messages') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.equipment.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all duration-300 relative">
                        @if(($notifications['equipment'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['equipment'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-cyan-500/20 border border-cyan-500/30 rounded-xl flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-cyan-400 transition-colors">{{ __('Equipment') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.reports') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-rose-500/50 hover:bg-rose-500/10 transition-all duration-300 relative">
                        @if(($notifications['reports'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['reports'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-rose-500/20 border border-rose-500/30 rounded-xl flex items-center justify-center text-rose-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-rose-400 transition-colors">{{ __('Reports') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-indigo-500/50 hover:bg-indigo-500/10 transition-all duration-300 relative">
                        @if(($notifications['users'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['users'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-indigo-500/20 border border-indigo-500/30 rounded-xl flex items-center justify-center text-indigo-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-indigo-400 transition-colors">{{ __('Users') }}</span>
                    </a>
                    
                    <a href="{{ route('admin.course-requests.index') }}" class="group flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-violet-500/50 hover:bg-violet-500/10 transition-all duration-300 relative">
                        @if(($notifications['requests'] ?? 0) > 0)
                        <span class="absolute w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg shadow-red-500/30 z-50" style="top: -6px; right: -6px;">
                            {{ $notifications['requests'] }}
                        </span>
                        @endif
                        <div class="w-12 h-12 bg-violet-500/20 border border-violet-500/30 rounded-xl flex items-center justify-center text-violet-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-300 group-hover:text-violet-400 transition-colors">{{ __('Requests') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
