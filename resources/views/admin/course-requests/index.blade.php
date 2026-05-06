<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Course Requests Management') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 p-4 mb-6 rounded-xl">
                    <p class="text-emerald-400">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Total Requests') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total_requests'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Ready to Start') }}</p>
                            <p class="text-3xl font-bold text-emerald-400">{{ $stats['courses_ready'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Pending') }}</p>
                            <p class="text-3xl font-bold text-amber-400">{{ $stats['pending_courses'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-amber-500/20 border border-amber-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(count($coursesData) > 0)
                <!-- Course Requests List -->
                <div class="space-y-6">
                    @foreach($coursesData as $courseName => $data)
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition-all">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/25">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"/></svg>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-white">{{ $courseName }}</h3>
                                            <p class="text-sm text-slate-400">{{ $data['request_count'] }} {{ __('student(s) interested') }}</p>
                                        </div>
                                    </div>

                                    @if($data['is_ready'])
                                        <span class="bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 px-4 py-2 rounded-full font-bold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            {{ __('Ready to Start') }}
                                        </span>
                                    @else
                                        <span class="bg-amber-500/20 border border-amber-500/30 text-amber-400 px-4 py-2 rounded-full font-bold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/></svg>
                                            {{ __('Needs') }} {{ 3 - $data['request_count'] }} {{ __('more') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Student Requests Table -->
                                <div class="overflow-x-auto mt-4">
                                    <table class="min-w-full divide-y divide-white/10">
                                        <thead class="bg-white/5">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Student Name') }}</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Phone') }}</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Preferred Teacher') }}</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Preferred Time') }}</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Requested') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-white/10">
                                            @foreach($data['requests'] as $request)
                                                <tr class="hover:bg-white/5 transition">
                                                    <td class="px-4 py-3 text-sm text-white">{{ $request->student_name }}</td>
                                                    <td class="px-4 py-3 text-sm text-slate-400">{{ $request->student_phone }}</td>
                                                    <td class="px-4 py-3 text-sm">
                                                        @if($request->preferred_teacher)
                                                            <span class="bg-purple-500/20 border border-purple-500/30 text-purple-400 px-2 py-1 rounded text-xs flex items-center gap-1 w-fit">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                                {{ $request->preferred_teacher }}
                                                            </span>
                                                        @else
                                                            <span class="text-slate-500">{{ __('No preference') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 text-sm">
                                                        @if($request->preferred_time)
                                                            <span class="bg-blue-500/20 border border-blue-500/30 text-blue-400 px-2 py-1 rounded text-xs flex items-center gap-1 w-fit">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/></svg>
                                                                {{ $request->preferred_time }}
                                                            </span>
                                                        @else
                                                            <span class="text-slate-500">{{ __('Not specified') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-slate-400">{{ $request->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-6 flex gap-3">
                                    @if($data['is_ready'])
                                        <button onclick="openCreateCourseModal('{{ $courseName }}')" 
                                            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            {{ __('Create Course') }}
                                        </button>
                                    @endif
                                    
                                    <form action="{{ route('admin.course-requests.notify', $courseName) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                            {{ __('Notify Admin') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                    <svg class="w-20 h-20 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Course Requests') }}</h3>
                    <p class="text-slate-400">{{ __('There are no pending course requests at the moment.') }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Create Course Modal -->
    <div id="createCourseModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeCreateCourseModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 text-left shadow-[0_0_60px_rgba(0,0,0,0.5)] transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-6 text-white">
                        <h3 class="text-2xl font-bold">{{ __('Create Course:') }} <span id="modal_course_name"></span></h3>
                        <p class="text-emerald-100 text-sm mt-1">{{ __('Set up the course details and enroll waiting students') }}</p>
                    </div>

                    <form id="createCourseForm" method="POST" class="p-6">
                        @csrf
                        <input type="hidden" name="_method" value="POST">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Course Name') }}</label>
                                <input type="text" id="display_course_name" 
                                    class="w-full px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-slate-400 cursor-not-allowed" readonly>
                            </div>

                            <div>
                                <label for="teacher_id" class="block text-sm font-medium text-slate-300 mb-1">
                                    {{ __('Teacher') }} <span class="text-red-400">*</span>
                                </label>
                                <select name="teacher_id" id="teacher_id" required
                                    class="w-full px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                                    <option value="">{{ __('Select Teacher') }}</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-slate-300 mb-1">
                                    {{ __('Price ($)') }} <span class="text-red-400">*</span>
                                </label>
                                <input type="number" name="price" id="price" step="0.01" min="0" required
                                    class="w-full px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                            </div>

                            <div>
                                <label for="scheduled_start_time" class="block text-sm font-medium text-slate-300 mb-1">
                                    {{ __('Scheduled Start Time') }}
                                </label>
                                <input type="text" name="scheduled_start_time" id="scheduled_start_time"
                                    placeholder="{{ __('e.g., 3:00 PM') }}"
                                    class="w-full px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-slate-300 mb-1">
                                    {{ __('Description') }}
                                </label>
                                <textarea name="description" id="description" rows="3"
                                    class="w-full px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-3">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-4 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] transition-all font-semibold">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ __('Create & Enroll Students') }}
                            </button>
                            <button type="button" onclick="closeCreateCourseModal()" 
                                class="px-6 py-3 bg-white/5 border border-white/10 text-slate-300 rounded-xl hover:bg-white/10 transition-all">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCreateCourseModal(courseName) {
            document.getElementById('modal_course_name').textContent = courseName;
            document.getElementById('display_course_name').value = courseName;
            document.getElementById('createCourseForm').action = `/admin/course-requests/${encodeURIComponent(courseName)}/create-course`;
            document.getElementById('createCourseModal').classList.remove('hidden');
        }

        function closeCreateCourseModal() {
            document.getElementById('createCourseModal').classList.add('hidden');
        }

        document.getElementById('createCourseModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateCourseModal();
            }
        });
    </script>
</x-app-layout>
