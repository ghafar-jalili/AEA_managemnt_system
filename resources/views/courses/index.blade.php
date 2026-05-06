<x-app-layout>
    @push('scripts')
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
    @endpush

    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto mb-12" data-animate="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-blue-400 text-sm font-medium border border-white/10 mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"/>
                    </svg>
                    {{ __('All Courses') }}
                </div>
                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4 tracking-tight">
                    {{ __('Explore Our') }} 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Courses') }}</span>
                </h1>
                <p class="text-lg text-slate-400">
                    {{ __('Find the perfect course to advance your engineering career') }}
                </p>
            </div>
            
            {{-- Search Bar --}}
            <div class="mb-12 overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 p-6" data-animate="fade-up">
                <form method="GET" action="{{ route('courses.public.index') }}" class="flex gap-4 flex-wrap">
                    <div class="flex-1 min-w-[200px]">
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ $search ?? '' }}"
                                placeholder="Search by course title or teacher name..."
                                class="w-full pl-12 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                        </div>
                    </div>
                    <div class="w-48">
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            <select name="status" class="w-full pl-12 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer">
                                <option value="" class="bg-slate-900">{{ __('All Status') }}</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }} class="bg-slate-900">{{ __('Active') }}</option>
                                <option value="will_start_soon" {{ request('status') === 'will_start_soon' ? 'selected' : '' }} class="bg-slate-900">{{ __('Will Start Soon') }}</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }} class="bg-slate-900">{{ __('Inactive') }}</option>
                            </select>
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] hover:-translate-y-0.5 transition-all duration-300">
                        {{ __('Search') }}
                    </button>
                    @if($search || request('status'))
                        <a href="{{ route('courses.public.index') }}" class="px-8 py-3 bg-white/5 border border-white/10 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/20 transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Clear') }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Courses Grid -->
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="group relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(139,92,246,0.15)]">
                            <!-- Course Thumbnail -->
                            <div class="relative aspect-video overflow-hidden">
                                @if($course->thumbnail && file_exists(storage_path('app/public/' . $course->thumbnail)))
                                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-600/20 to-purple-600/20 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                                
                                <!-- Status Badge -->
                                @if($course->status === 'will_start_soon')
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500/80 backdrop-blur-sm text-white text-xs font-bold rounded-full shadow-lg animate-pulse">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/>
                                            </svg>
                                            {{ __('Starting Soon') }}
                                        </span>
                                    </div>
                                @endif
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('courses.public.show', $course) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)]">
                                        {{ __('View Course') }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Course Info -->
                            <div class="p-6 relative">
                                @if($course->category)
                                    <span class="inline-block px-3 py-1 mb-3 bg-blue-500/10 text-blue-400 text-xs font-medium rounded-lg border border-blue-500/20">
                                        {{ $course->category }}
                                    </span>
                                @endif
                                
                                <h3 class="text-lg font-bold text-white mb-2 group-hover:text-blue-400 transition-colors line-clamp-1">{{ $course->title }}</h3>
                                
                                @if($course->status === 'will_start_soon')
                                    <div class="mb-3 px-3 py-2 bg-amber-500/10 border border-amber-500/20 rounded-lg">
                                        <p class="text-sm text-amber-400 font-medium inline-flex items-start gap-2">
                                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>{{ __('This course will start soon. Enroll now to get notified!') }}</span>
                                        </p>
                                    </div>
                                @endif
                                
                                <div class="flex items-center gap-3 mb-3 text-slate-400 text-sm">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $course->teacher_name }}
                                    </span>
                                </div>
                                
                                <!-- Student Count -->
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>
                                    </svg>
                                    <button type="button" onclick="openStudentListModal({{ $course->id }}, '{{ addslashes($course->title) }}')" class="text-sm font-semibold text-blue-400 hover:text-blue-300 hover:underline cursor-pointer">
                                        {{ $course->enrolled_students_count ?? 0 }}
                                    </button>
                                    <span class="text-sm text-slate-400">{{ __('students enrolled') }}</span>
                                </div>

                                <!-- Course Time -->
                                @if($course->course_time)
                                    <div class="flex items-center gap-2 mb-3 text-cyan-400 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="font-semibold">{{ $course->course_time }}</span>
                                    </div>
                                @endif

                                <!-- Start Date/Time for Active Courses -->
                                @if($course->status === 'active' && $course->scheduled_start_time)
                                    <div class="flex items-center gap-2 mb-3 text-emerald-400 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ __('Starts') }}: <span class="font-semibold">{{ \Carbon\Carbon::parse($course->scheduled_start_time)->format('M d, Y - h:i A') }}</span></span>
                                    </div>
                                @endif
                                
                                <p class="text-sm text-slate-400 mb-4 line-clamp-2">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <span class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                        @if($course->price > 0)
                                            {{ number_format($course->price, 2) }} AF
                                        @else
                                            <span class="text-emerald-400 font-semibold">{{ __('Free') }}</span>
                                        @endif
                                    </span>
                                    <a href="{{ route('courses.public.show', $course) }}" class="text-sm font-semibold text-white hover:text-blue-400 transition-colors inline-flex items-center gap-1 group/link">
                                        {{ __('Details') }}
                                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-4 space-y-2">
                                    @auth
                                        @if(auth()->user()->isAdmin())
                                            <!-- Admin: Add Student Button -->
                                            <button onclick="openAddStudentModal('{{ addslashes($course->title) }}')" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-4 py-2.5 rounded-lg hover:shadow-lg transition transform hover:-translate-y-0.5 text-sm font-semibold flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                                </svg>
                                                Add Student
                                            </button>
                                        @else
                                            @php
                                                $userEnrollment = $userEnrollmentsByCourseId[$course->id] ?? null;
                                                $hasCourseRequest = $hasCourseRequestByCourseTitle[$course->title] ?? false;
                                            @endphp
                                            @if(!$userEnrollment && !$hasCourseRequest)
                                                <!-- Logged in user: I Want to Start -->
                                                <button onclick="openWantToStartModal('{{ addslashes($course->title) }}')" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2.5 rounded-lg hover:shadow-lg transition transform hover:-translate-y-0.5 text-sm font-semibold flex items-center justify-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                    I Want to Start
                                                </button>
                                            @elseif($hasCourseRequest)
                                                <div class="w-full bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 px-4 py-2.5 rounded-lg text-sm font-semibold text-center">
                                                    Request Submitted
                                                </div>
                                            @elseif($userEnrollment->status === 'pending')
                                                <div class="w-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300 px-4 py-2.5 rounded-lg text-sm font-semibold text-center">
                                                    Enrollment Pending
                                                </div>
                                            @elseif(in_array($userEnrollment->status, ['approved', 'completed']))
                                                <div class="w-full bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 px-4 py-2.5 rounded-lg text-sm font-semibold text-center">
                                                    Already Enrolled
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        <!-- Guest: I Want to Start (redirect to login) -->
                                        <a href="{{ route('login', ['redirect' => route('course-request.form', ['course' => $course->title])]) }}" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2.5 rounded-lg hover:shadow-lg transition transform hover:-translate-y-0.5 text-sm font-semibold flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            I Want to Start
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $courses->appends(['search' => $search, 'status' => $status])->links() }}
                </div>
            @else
                <div class="bg-white  overflow-hidden shadow-lg sm:rounded-xl p-16 text-center border border-slate-200 ">
                    <svg class="mx-auto h-16 w-16 text-gray-400 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 ">No courses found</h3>
                    <p class="mt-2 text-gray-600 ">
                        @if($search)
                            No courses match your search. Try different keywords.
                        @else
                            There are no courses available at the moment.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

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

    <!-- Student List Modal -->
    <div id="studentListModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeStudentListModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold leading-6 text-gray-900" id="studentListModalTitle">Students</h3>
                            <button onclick="closeStudentListModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div id="studentListContent" class="max-h-96 overflow-y-auto">
                            <div class="flex justify-center py-8">
                                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
