<x-app-layout>
    {{-- Hero Section with Dark Background --}}
    <section class="relative pt-24 pb-16 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Course Details -->
                <div class="lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500">
                        <!-- Course Thumbnail -->
                        @if($course->thumbnail && file_exists(storage_path('app/public/' . $course->thumbnail)))
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-96 object-cover">
                        @else
                            <div class="w-full h-96 bg-gradient-to-br from-blue-600/30 via-purple-600/30 to-pink-600/30 flex items-center justify-center">
                                <svg class="w-32 h-32 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Course Info -->
                        <div class="p-8">
                            <h1 class="text-3xl lg:text-4xl font-bold text-white mb-4">{{ $course->title }}</h1>
                            
                            <!-- Course Stats -->
                            <div class="flex flex-wrap items-center gap-6 mb-6 pb-6 border-b border-white/10">
                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($course->teacher_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500">{{ __('Instructor') }}</p>
                                        <span class="text-white font-semibold">{{ $course->teacher_name }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500">{{ __('Students') }}</p>
                                        <span class="text-white font-bold">{{ $course->enrolled_students_count ?? 0 }}</span>
                                    </div>
                                </div>

                                @if($course->course_time)
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">{{ __('Schedule') }}</p>
                                            <span class="text-white font-semibold">{{ $course->course_time }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-red-500 rounded-full flex items-center justify-center text-white">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500">{{ __('Lessons') }}</p>
                                        <span class="text-white font-bold">{{ $course->lessons->count() }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500">{{ __('Created') }}</p>
                                        <span class="text-white font-semibold">{{ $course->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Description -->
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ __('About This Course') }}
                                </h3>
                                <div class="bg-slate-900/50 rounded-xl p-6 border border-white/10">
                                    <p class="text-slate-400 leading-relaxed whitespace-pre-line text-lg">{{ $course->description ?? __('No description available for this course.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Price Card -->
                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 sticky top-8 border border-white/10 hover:border-white/20 transition-all duration-500">
                        <div class="text-center mb-6 pb-6 border-b border-white/10">
                            @if($course->price > 0)
                                <div class="text-4xl lg:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-2">{{ number_format($course->price, 2) }} AF</div>
                                <p class="text-slate-400">{{ __('One-time payment') }}</p>
                            @else
                                <div class="text-4xl lg:text-5xl font-bold text-emerald-400 mb-2">{{ __('Free') }}</div>
                                <p class="text-slate-400">{{ __('Start learning today') }}</p>
                            @endif
                        </div>

                        @auth
                            @if(auth()->user()->isAdmin())
                                <!-- Admin: Add Student Button -->
                                <button onclick="openAddStudentModal('{{ addslashes($course->title) }}')" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all font-semibold mb-4 flex items-center justify-center gap-2 hover:-translate-y-0.5 duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    {{ __('Add Student') }}
                                </button>
                            @endif
                            
                            @if($enrollment)
                                @if($enrollment->status === 'approved' || $enrollment->status === 'completed')
                                    <div class="bg-emerald-500/10 border border-emerald-500/20 p-4 mb-4 rounded-xl">
                                        <p class="text-emerald-400 font-semibold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ __('You are enrolled in this course') }}
                                        </p>
                                    </div>
                                    
                                    @if(!$certificate)
                                        <form action="{{ route('student.claim.certificate', $enrollment) }}" method="POST" class="mb-4">
                                            @csrf
                                            <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(147,51,234,0.5)] transition-all font-semibold flex items-center justify-center gap-2 hover:-translate-y-0.5 duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                </svg>
                                                {{ __('Claim Certificate') }}
                                            </button>
                                        </form>
                                    @elseif(!$certificate->is_verified)
                                        <div class="mb-4 bg-amber-500/10 border border-amber-500/20 p-3 rounded-xl">
                                            <p class="text-amber-400 text-sm font-semibold">⏳ {{ __('Certificate Requested') }}</p>
                                            <p class="text-amber-400/70 text-xs">{{ __('Pending admin approval') }}</p>
                                        </div>
                                    @else
                                        <div class="mb-4 bg-emerald-500/10 border border-emerald-500/20 p-3 rounded-xl">
                                            <p class="text-emerald-400 text-sm font-semibold">✓ {{ __('Certificate Approved') }}</p>
                                            <a href="{{ route('student.certificates') }}" class="text-emerald-400/70 text-xs hover:text-emerald-400 transition-colors">{{ __('View & Download') }}</a>
                                        </div>
                                    @endif
                                    
                                    @if($course->lessons->count() > 0)
                                        <a href="{{ route('student.lesson.show', [$course, $course->lessons->first()]) }}" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all font-semibold mb-4 block text-center hover:-translate-y-0.5 duration-300">
                                            {{ __('Start Learning →') }}
                                        </a>
                                    @else
                                        <div class="bg-slate-900/50 border border-white/10 p-4 mb-4 rounded-xl">
                                            <p class="text-slate-400 font-semibold">📚 {{ __('No lessons available yet') }}</p>
                                            <p class="text-slate-500 text-sm mt-1">{{ __('Lessons will be added by the instructor soon') }}</p>
                                        </div>
                                    @endif
                                @elseif($enrollment->status === 'pending')
                                    <div class="bg-amber-500/10 border border-amber-500/20 p-4 mb-4 rounded-xl">
                                        <p class="text-amber-400 font-semibold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ __('Enrollment Pending Approval') }}
                                        </p>
                                        <p class="text-amber-400/70 text-sm mt-1">{{ __('You can watch the first 3 lessons while waiting') }}</p>
                                    </div>
                                    @if($course->lessons->count() > 0)
                                        <a href="{{ route('student.lesson.show', [$course, $course->lessons->where('order', '<=', 3)->first()]) }}" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold mb-4 block text-center hover:-translate-y-0.5 duration-300">
                                            {{ __('Watch Free Preview (First 3 Lessons)') }}
                                        </a>
                                    @else
                                        <div class="bg-slate-900/50 border border-white/10 p-4 mb-4 rounded-xl">
                                            <p class="text-slate-400 font-semibold">📚 {{ __('No lessons available yet') }}</p>
                                            <p class="text-slate-500 text-sm mt-1">{{ __('Lessons will be added by the instructor soon') }}</p>
                                        </div>
                                    @endif
                                @elseif($enrollment->status === 'rejected')
                                    <div class="bg-red-500/10 border border-red-500/20 p-4 mb-4 rounded-xl">
                                        <p class="text-red-400 font-semibold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m0 0l2 2m0 0l-2 2m0 0l-2-2m0 0l-2 2m0 0l2-2m0 0l2 2m0 0l-2-2"/>
                                            </svg>
                                            {{ __('Enrollment Rejected') }}
                                        </p>
                                        @if($enrollment->admin_notes)
                                            <p class="text-red-400/70 text-sm mt-1">{{ __('Reason') }}: {{ $enrollment->admin_notes }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('student.enroll', $course) }}" method="POST" class="mb-4">
                                        @csrf
                                        <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold hover:-translate-y-0.5 duration-300">
                                            {{ __('Request Enrollment Again') }}
                                        </button>
                                    </form>
                                @endif
                            @else
                                @if($hasCourseRequest)
                                    <div class="w-full bg-blue-500/10 border border-blue-500/20 text-blue-400 px-6 py-3 rounded-xl mb-4 text-sm font-semibold text-center">
                                        {{ __('Request Submitted - We will contact you soon!') }}
                                    </div>
                                @else
                                    <!-- Logged in user: I Want to Start -->
                                    <button onclick="openWantToStartModal('{{ addslashes($course->title) }}')" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(249,115,22,0.5)] transition-all font-semibold mb-4 block text-center hover:-translate-y-0.5 duration-300 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        {{ __('I Want to Start') }}
                                    </button>
                                @endif
                                <form action="{{ route('student.enroll', $course) }}" method="POST" class="mb-4">
                                    @csrf
                                    <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold hover:-translate-y-0.5 duration-300">
                                        {{ __('Quick Enroll (No Time Preference)') }}
                                    </button>
                                </form>
                                @if($course->lessons->count() > 0)
                                    @if($freePreviewLesson)
                                        <a href="{{ route('student.lesson.show', [$course, $freePreviewLesson]) }}" class="w-full bg-white/5 border border-white/10 text-white px-6 py-3 rounded-xl hover:bg-white/10 hover:border-white/20 transition-all font-semibold mb-4 block text-center hover:-translate-y-0.5 duration-300">
                                            {{ __('Watch Free Preview') }}
                                        </a>
                                    @endif
                                @endif
                            @endif
                        @else
                            <!-- Guest: I Want to Start (redirect to login with intended URL) -->
                            <a href="{{ route('login', ['redirect' => route('course-request.form', ['course' => $course->title])]) }}" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(249,115,22,0.5)] transition-all font-semibold mb-4 block text-center hover:-translate-y-0.5 duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ __('I Want to Start') }}
                            </a>
                            <a href="{{ route('login') }}" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold mb-4 block text-center hover:-translate-y-0.5 duration-300">
                                {{ __('Login to Enroll') }}
                            </a>
                        @endauth

                        <div class="border-t border-white/10 pt-6 space-y-4">
                            <h4 class="font-bold text-white mb-3">{{ __('This course includes:') }}</h4>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-slate-400">{{ __('Lifetime access') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-slate-400">{{ __('Learn at your own pace') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-slate-400">{{ __('Certificate of completion') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span class="text-slate-400">{{ $course->lessons->count() }} {{ __('lessons') }}</span>
                            </div>
                        </div>

                        <!-- Course Lessons List -->
                        @if($course->lessons->count() > 0)
                            <div class="border-t border-white/10 pt-6 mt-6">
                                <h4 class="font-bold text-white mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    {{ __('Course Lessons') }}
                                </h4>
                                <div class="space-y-2 max-h-[400px] overflow-y-auto">
                                    @foreach($course->lessons->sortBy('order') as $lesson)
                                        @php
                                            $canAccess = !auth()->check() ? ($lesson->is_free ?? false) : 
                                                        ($enrollment ? in_array($enrollment->status, ['approved', 'completed', 'pending']) : ($lesson->is_free ?? false));
                                        @endphp
                                        @if($canAccess)
                                            <a href="{{ route('student.lesson.show', [$course, $lesson]) }}" class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-xl border border-white/10 hover:border-white/20 hover:bg-slate-800/50 transition-all cursor-pointer group">
                                                <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 text-sm">
                                                    {{ $lesson->order }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h5 class="font-semibold text-white text-sm truncate group-hover:text-blue-400 transition-colors">{{ $lesson->title }}</h5>
                                                    @if($lesson->duration)
                                                        <p class="text-xs text-slate-400">{{ $lesson->duration }}</p>
                                                    @endif
                                                </div>
                                                <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-400 flex-shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        @else
                                            <div class="flex items-center gap-3 p-3 bg-slate-900/30 rounded-xl border border-white/5 opacity-60">
                                                <div class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 text-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h5 class="font-semibold text-slate-400 text-sm truncate">{{ $lesson->title }}</h5>
                                                    <p class="text-xs text-slate-500">{{ __('Enrollment required') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- I Want to Start Modal (Logged-in User) -->
    <div id="wantToStartModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeWantToStartModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 text-left shadow-[0_0_60px_rgba(0,0,0,0.5)] transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-500/20 border border-orange-500/30 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-orange-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title">{{ __('I Want to Start This Course') }}</h3>
                                <p class="text-sm text-slate-400 mt-1" id="wantToStartCourseName"></p>
                                <form id="wantToStartForm" action="{{ route('course-request.quick') }}" method="POST" class="mt-4 space-y-4">
                                    @csrf
                                    <input type="hidden" name="course_name" id="wantToStartCourseNameInput">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Name') }} <span class="text-red-400">*</span></label>
                                        <input type="text" name="student_name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required pattern="[a-zA-Z\s]+" title="Only letters and spaces allowed" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 px-3 py-2 transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Father Name') }} <span class="text-red-400">*</span></label>
                                        <input type="text" name="father_name" value="{{ auth()->check() ? auth()->user()->father_name : '' }}" required pattern="[a-zA-Z\s]+" title="Only letters and spaces allowed" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 px-3 py-2 transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Mobile Number') }} <span class="text-red-400">*</span></label>
                                        <input type="tel" name="student_phone" value="{{ auth()->check() ? auth()->user()->phone : '' }}" required pattern="[0-9]+" title="Only numbers allowed" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 px-3 py-2 transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Preferred Time') }} <span class="text-red-400">*</span></label>
                                        <input type="text" name="preferred_time" placeholder="e.g. Monday 10:00 AM" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 px-3 py-2 transition-all">
                                    </div>
                                    <div class="mt-4 flex justify-end gap-3">
                                        <button type="button" onclick="closeWantToStartModal()" class="px-4 py-2 bg-white/5 border border-white/10 text-slate-300 rounded-xl hover:bg-white/10 transition text-sm font-medium">{{ __('Cancel') }}</button>
                                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl hover:shadow-[0_0_20px_rgba(249,115,22,0.5)] transition text-sm font-medium">{{ __('Submit Request') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.add-student-modal')

    <script>
        function openWantToStartModal(courseName) {
            document.getElementById('wantToStartCourseName').textContent = courseName;
            document.getElementById('wantToStartCourseNameInput').value = courseName;
            document.getElementById('wantToStartModal').classList.remove('hidden');
        }
        function closeWantToStartModal() {
            document.getElementById('wantToStartModal').classList.add('hidden');
        }
        function openAddStudentModal(courseName) {
            document.getElementById('addStudentCourseName').textContent = courseName;
            document.getElementById('addStudentCourseNameInput').value = courseName;
            document.getElementById('addStudentModal').classList.remove('hidden');
        }
        function closeAddStudentModal() {
            document.getElementById('addStudentModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
