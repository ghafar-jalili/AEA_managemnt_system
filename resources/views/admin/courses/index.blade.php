<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ __('Manage Courses') }}
            </h2>
            <a href="{{ route('admin.courses.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center gap-2 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                {{ __('Create New Course') }}
            </a>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-emerald-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Search Bar -->
            <div class="mb-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <form method="GET" action="{{ route('admin.courses.index') }}" class="flex gap-4 flex-wrap">
                    <div class="flex-1 min-w-[200px]">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $search ?? '' }}"
                            placeholder="{{ __('Search by course title, teacher name, or description...') }}"
                            class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 px-4 py-3 outline-none transition-all"
                        >
                    </div>
                    <div class="w-48">
                        <select name="status" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white px-4 py-3 outline-none focus:border-blue-500 transition-all">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="will_start_soon" {{ request('status') === 'will_start_soon' ? 'selected' : '' }}>{{ __('Will Start Soon') }}</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 flex items-center gap-2 font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        {{ __('Search') }}
                    </button>
                    @if($search || request('status'))
                        <a href="{{ route('admin.courses.index') }}" class="bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 px-6 py-3 rounded-xl transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Clear') }}
                        </a>
                    @endif
                </form>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,0,0,0.5)] group">
                        <!-- Course Thumbnail -->
                        <div class="relative h-48 overflow-hidden">
                            @if($course->thumbnail && file_exists(storage_path('app/public/' . $course->thumbnail)))
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 items-center justify-center hidden">
                                    <i class="fas fa-book text-white text-5xl opacity-50"></i>
                                </div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <i class="fas fa-book text-white text-5xl opacity-50"></i>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                @if($course->status === 'active')
                                    <span class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                                        <i class="fas fa-check-circle mr-1"></i>Active
                                    </span>
                                @elseif($course->status === 'will_start_soon')
                                    <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full shadow-lg">
                                        <i class="fas fa-clock mr-1"></i>Will Start Soon
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full shadow-lg">
                                        <i class="fas fa-times-circle mr-1"></i>Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Course Info -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-400 transition-colors">{{ $course->title }}</h3>
                            <p class="text-sm text-slate-400 mb-4 line-clamp-2">{{ Str::limit($course->description, 80) }}</p>
                            
                            <!-- Course Meta -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-slate-300">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                    <span class="font-medium">{{ $course->teacher_name }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-300">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <button onclick="openStudentListModal({{ $course->id }}, '{{ addslashes($course->title) }}')" class="font-medium text-blue-400 hover:text-blue-300 transition-colors cursor-pointer">
                                        {{ $course->enrolled_students_count ?? 0 }} {{ __('Students') }}
                                    </button>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-300">
                                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    @if($course->price > 0)
                                        <span class="font-bold text-emerald-400">{{ number_format($course->price, 2) }} AF</span>
                                    @else
                                        <span class="font-bold text-emerald-400">{{ __('Free') }}</span>
                                    @endif
                                </div>
                                @if($course->course_time)
                                    <div class="flex items-center gap-2 text-sm text-slate-300">
                                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-cyan-400">{{ $course->course_time }}</span>
                                    </div>
                                @endif
                                <div class="flex items-center gap-2 text-sm text-slate-300">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $course->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="pt-4 border-t border-white/10">
                                <div class="flex flex-row gap-2">
                                    <button onclick="openAddStudentModal('{{ addslashes($course->title) }}')" class="flex-1 flex items-center justify-center gap-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-2 py-2 text-xs font-semibold rounded-lg transition-all shadow-md hover:shadow-lg">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                        {{ __('Add') }}
                                    </button>
                                    <form action="{{ route('admin.courses.toggle-status', $course) }}" method="POST" class="flex-1 flex">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center gap-1 text-xs font-semibold rounded-lg transition-all
                                            @if($course->status === 'active') bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500/30
                                            @elseif($course->status === 'will_start_soon') bg-amber-500/20 border border-amber-500/30 text-amber-400 hover:bg-amber-500/30
                                            @else bg-red-500/20 border border-red-500/30 text-red-400 hover:bg-red-500/30
                                            @endif">
                                            @if($course->status === 'active')
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @elseif($course->status === 'will_start_soon')
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                            {{ $course->status === 'active' ? __('Active') : ($course->status === 'will_start_soon' ? __('Soon') : __('Inactive')) }}
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.lessons.index', $course) }}" class="flex-1 flex items-center justify-center gap-1 px-2 py-2 bg-purple-500/20 border border-purple-500/30 text-purple-400 text-xs font-semibold rounded-lg hover:bg-purple-500/30 transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Lessons') }}
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="flex-1 flex items-center justify-center gap-1 px-2 py-2 bg-blue-500/20 border border-blue-500/30 text-blue-400 text-xs font-semibold rounded-lg hover:bg-blue-500/30 transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this course?') }}');" class="flex-1 flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center gap-1 px-2 py-2 bg-red-500/20 border border-red-500/30 text-red-400 text-xs font-semibold rounded-lg hover:bg-red-500/30 transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                        <svg class="w-20 h-20 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"/>
                        </svg>
                        <h3 class="text-xl font-bold text-white mb-2">{{ __('No courses found') }}</h3>
                        <p class="text-slate-400 mb-6">
                            @if($search)
                                {{ __('No courses match your search. Try different keywords.') }}
                            @else
                                {{ __('Get started by creating your first course!') }}
                            @endif
                        </p>
                        @if(!$search)
                            <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                {{ __('Create New Course') }}
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        </div>
    </div>

    @include('partials.add-student-modal')

    <!-- Student List Modal -->
    <div id="studentListModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeStudentListModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 text-left shadow-[0_0_60px_rgba(0,0,0,0.5)] transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold leading-6 text-white" id="studentListModalTitle">{{ __('Students') }}</h3>
                            <button onclick="closeStudentListModal()" class="text-slate-400 hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <div id="studentListContent" class="max-h-96 overflow-y-auto">
                            <div class="flex justify-center py-8">
                                <svg class="animate-spin h-8 w-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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

    <script>
        function openAddStudentModal(courseName) {
            document.getElementById('addStudentCourseName').textContent = courseName;
            document.getElementById('addStudentCourseNameInput').value = courseName;
            document.getElementById('addStudentModal').classList.remove('hidden');
        }
        function closeAddStudentModal() {
            document.getElementById('addStudentModal').classList.add('hidden');
        }

        function openStudentListModal(courseId, courseTitle) {
            document.getElementById('studentListModalTitle').textContent = 'Students - ' + courseTitle;
            document.getElementById('studentListModal').classList.remove('hidden');
            loadStudents(courseId);
        }

        function closeStudentListModal() {
            document.getElementById('studentListModal').classList.add('hidden');
        }

        function loadStudents(courseId) {
            const contentDiv = document.getElementById('studentListContent');
            contentDiv.innerHTML = '<div class="flex justify-center py-8"><svg class="animate-spin h-8 w-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>';
            
            fetch('{{ url('/admin/courses') }}/' + courseId + '/students')
                .then(response => response.json())
                .then(data => {
                    if (data.students && data.students.length > 0) {
                        let html = '<table class="min-w-full divide-y divide-white/10"><thead class="bg-white/5"><tr><th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th><th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Enrolled Date</th></tr></thead><tbody class="divide-y divide-white/10">';
                        data.students.forEach(student => {
                            let statusBadge = '';
                            if (student.status === 'approved' || student.status === 'completed') {
                                statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-400">' + student.status + '</span>';
                            } else if (student.status === 'pending') {
                                statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-500/20 border border-amber-500/30 text-amber-400">' + student.status + '</span>';
                            } else {
                                statusBadge = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-500/20 border border-slate-500/30 text-slate-400">' + student.status + '</span>';
                            }
                            html += '<tr class="hover:bg-white/5 transition"><td class="px-6 py-4 whitespace-nowrap text-sm text-white">' + student.name + '</td><td class="px-6 py-4 whitespace-nowrap text-sm">' + statusBadge + '</td><td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">' + student.enrolled_at + '</td></tr>';
                        });
                        html += '</tbody></table>';
                        contentDiv.innerHTML = html;
                    } else {
                        contentDiv.innerHTML = '<div class="text-center py-8 text-slate-400">{{ __('No students enrolled in this course yet.') }}</div>';
                    }
                })
                .catch(error => {
                    contentDiv.innerHTML = '<div class="text-center py-8 text-red-400">{{ __('Error loading students. Please try again.') }}</div>';
                });
        }
    </script>
</x-app-layout>
