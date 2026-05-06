<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-10" data-aos="fade-up">
                <h1 class="text-3xl font-bold text-white">{{ __('Welcome back') }}, {{ auth()->user()->name }}</h1>
                <p class="mt-2 text-slate-400">{{ __('Track your teaching footprint at a glance.') }}</p>
            </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-blue-500/30 transition-all" data-aos="fade-up" data-aos-delay="0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-blue-400">{{ __('My courses') }}</p>
                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="mt-4 text-4xl font-bold text-white">{{ auth()->user()->courses()->count() }}</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-emerald-500/30 transition-all" data-aos="fade-up" data-aos-delay="60">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-emerald-400">{{ __('Total lessons') }}</p>
                    <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <p class="mt-4 text-4xl font-bold text-white">{{ $lessonCount }}</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-purple-500/30 transition-all" data-aos="fade-up" data-aos-delay="120">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-purple-400">{{ __('Enrollments') }}</p>
                    <svg class="h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <p class="mt-4 text-4xl font-bold text-white">{{ $totalEnrollments }}</p>
            </div>
        </div>

        <div class="mt-10 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]" data-aos="fade-up">
            <h3 class="text-lg font-semibold text-white">{{ __('Quick actions') }}</h3>
            <p class="mt-1 text-sm text-slate-400">{{ __('Jump to the most common teacher workflows.') }}</p>

            <div class="mt-6 flex flex-wrap gap-4">
                <a
                    href="{{ route('teacher.courses.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] px-6 py-3 text-sm font-semibold text-white transition-all duration-300"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    {{ __('View my courses') }}
                </a>
                <a
                    href="{{ route('courses.public.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-6 py-3 text-sm font-semibold transition-all duration-300"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    {{ __('Browse catalog') }}
                </a>
                <a
                    href="{{ route('profile.edit') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-white px-6 py-3 text-sm font-semibold transition-all duration-300"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ __('Profile') }}
                </a>
            </div>

            <p class="mt-6 text-xs text-slate-500">
                {{ __('Course editing and lesson management are handled through the administrator workspace.') }}
            </p>
        </div>
    </div>
</x-app-layout>
