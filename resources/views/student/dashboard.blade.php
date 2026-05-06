<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-[0_0_30px_rgba(59,130,246,0.3)] p-8 mb-8 text-white">
                <h3 class="text-3xl font-bold mb-2">{{ __('Welcome, :name!', ['name' => auth()->user()->name]) }}</h3>
                <p class="text-blue-100">{{ __('You are logged in as :role', ['role' => __('Student')]) }}</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-slate-300">{{ __('My Courses') }}</h4>
                        <div class="w-12 h-12 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-white">{{ $myCoursesCount }}</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-slate-300">{{ __('Certificates') }}</h4>
                        <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-white">{{ $certificatesCount }}</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-slate-300">{{ __('Daily Lessons') }}</h4>
                        <div class="w-12 h-12 bg-purple-500/20 border border-purple-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-white">{{ $dailyLessonsCount }}</p>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <h4 class="text-xl font-semibold text-white mb-4">{{ __('Quick Actions') }}</h4>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('courses.public.index') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ __('Browse Courses') }}
                    </a>
                    <a href="{{ route('certificate.search') }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('Verify Certificate') }}
                    </a>
                    <a href="{{ route('student.certificates') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-[0_0_30px_rgba(168,85,247,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        {{ __('My Certificates') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
