<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('My courses') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ __('Courses you teach') }}</h1>
                    <p class="mt-1 text-slate-400">
                        {{ __('Quick overview of your assigned courses, lessons, and enrollments.') }}
                    </p>
                </div>
                <a
                    href="{{ route('teacher.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-4 py-2 text-sm font-semibold transition-all duration-300"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    {{ __('Back to dashboard') }}
                </a>
            </div>

        @if($courses->isEmpty())
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-12 text-center shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <svg class="mx-auto h-12 w-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-white">{{ __('No courses assigned yet') }}</h3>
                <p class="mt-2 text-slate-400">{{ __('When an administrator assigns you to a course, it will show up here.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach($courses as $course)
                    <article
                        class="flex flex-col rounded-2xl border border-white/10 bg-white/5 p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)] transition hover:border-white/20"
                        data-aos="fade-up"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $course->title }}</h3>
                                <p class="mt-1 text-sm text-slate-400">
                                    {{ __('Status') }}:
                                    <span class="font-semibold capitalize text-slate-300">{{ str_replace('_', ' ', $course->status) }}</span>
                                </p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-blue-500/20 px-3 py-1 text-xs font-semibold text-blue-400 border border-blue-500/30">
                                {{ $course->enrollments_count }} {{ __('enrollments') }}
                            </span>
                        </div>

                        <dl class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div class="rounded-xl bg-white/5 p-4 border border-white/10">
                                <dt class="text-slate-400">{{ __('Lessons') }}</dt>
                                <dd class="mt-1 text-2xl font-bold text-white">{{ $course->lessons->count() }}</dd>
                            </div>
                            <div class="rounded-xl bg-white/5 p-4 border border-white/10">
                                <dt class="text-slate-400">{{ __('Price') }}</dt>
                                <dd class="mt-1 text-2xl font-bold text-blue-400">
                                    @if($course->price > 0)
                                        {{ number_format($course->price, 2) }} AF
                                    @else
                                        <span class="text-emerald-400">{{ __('Free') }}</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a
                                href="{{ route('courses.public.show', $course) }}"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] px-4 py-2.5 text-sm font-semibold text-white transition-all duration-300 min-w-[140px]"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                {{ __('Public page') }}
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
