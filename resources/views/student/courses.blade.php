<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                    <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/20 p-4 rounded-xl">
                    <p class="text-red-400 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @if($enrollments->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($enrollments as $enrollment)
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition-all shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                            <!-- Course Thumbnail -->
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                                @if($enrollment->course->thumbnail && file_exists(storage_path('app/public/' . $enrollment->course->thumbnail)))
                                    <img src="{{ $enrollment->course->thumbnail_url }}" alt="{{ $enrollment->course->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    @if($enrollment->status === 'completed')
                                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold">{{ __('Completed') }}</span>
                                    @elseif($enrollment->status === 'approved')
                                        <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-full text-xs font-semibold">{{ __('Approved') }}</span>
                                    @elseif($enrollment->status === 'pending')
                                        <span class="px-3 py-1 bg-amber-500/20 text-amber-400 border border-amber-500/30 rounded-full text-xs font-semibold">{{ __('Pending') }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-purple-500/20 text-purple-400 border border-purple-500/30 rounded-full text-xs font-semibold">{{ __('In Progress') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Course Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $enrollment->course->title }}</h3>
                                <p class="text-sm text-slate-400 mb-2">
                                    <span class="font-medium text-slate-300">{{ __('Teacher:') }}</span> {{ $enrollment->course->teacher_name }}
                                </p>
                                <p class="text-sm text-slate-500 mb-4">
                                    {{ __('Enrolled:') }} {{ $enrollment->enrolled_at->format('M d, Y') }}
                                </p>
                                
                                <div class="flex gap-2">
                                    @if($enrollment->course->lessons->count() > 0)
                                        <a href="{{ route('student.lesson.show', [$enrollment->course, $enrollment->course->lessons->first()]) }}" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] text-white px-4 py-2 rounded-xl text-center text-sm font-semibold transition-all duration-300">
                                            {{ __('Watch Lessons') }}
                                        </a>
                                    @else
                                        <span class="flex-1 bg-slate-700/50 text-slate-400 px-4 py-2 rounded-xl text-center text-sm font-semibold cursor-not-allowed">
                                            {{ __('No Lessons Yet') }}
                                        </span>
                                    @endif
                                    @if($enrollment->status === 'active' || $enrollment->status === 'approved')
                                        <form action="{{ route('student.complete', $enrollment->course) }}" method="POST">
                                            @csrf
                                            <button class="bg-emerald-600 hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] text-white px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-300">
                                                {{ __('Complete') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                @if(in_array($enrollment->status, ['approved', 'completed']))
                                    @php
                                        $certificate = $certificatesByCourseId[$enrollment->course_id] ?? null;
                                    @endphp
                                    @if(!$certificate)
                                        <form action="{{ route('student.claim.certificate', $enrollment) }}" method="POST" class="mt-4">
                                            @csrf
                                            <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-[0_0_20px_rgba(168,85,247,0.5)] text-white px-4 py-3 rounded-xl text-sm font-semibold flex items-center justify-center gap-2 transition-all duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                </svg>
                                                {{ __('Claim Certificate') }}
                                            </button>
                                        </form>
                                    @elseif(!$certificate->is_verified)
                                        <div class="mt-4 bg-amber-500/10 border border-amber-500/20 p-3 rounded-xl">
                                            <p class="text-amber-400 text-sm font-semibold">⏳ {{ __('Certificate Requested') }}</p>
                                            <p class="text-amber-400/70 text-xs">{{ __('Pending admin approval') }}</p>
                                        </div>
                                    @else
                                        <div class="mt-4 bg-emerald-500/10 border border-emerald-500/20 p-3 rounded-xl">
                                            <p class="text-emerald-400 text-sm font-semibold">✓ {{ __('Certificate Approved') }}</p>
                                            <a href="{{ route('student.certificates') }}" class="text-emerald-400 text-xs hover:text-emerald-300 transition">{{ __('View & Download') }}</a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $enrollments->links() }}
                </div>
            @else
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-12 text-center shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <svg class="mx-auto h-16 w-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-white">{{ __('No courses yet') }}</h3>
                    <p class="mt-2 text-sm text-slate-400">{{ __('Get started by browsing our available courses.') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('courses.public.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white text-sm font-medium rounded-xl transition-all duration-300">
                            {{ __('Browse Courses') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
