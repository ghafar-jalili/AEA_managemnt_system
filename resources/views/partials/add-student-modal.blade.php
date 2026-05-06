<div id="addStudentModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeAddStudentModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 text-left shadow-[0_0_60px_rgba(0,0,0,0.5)] transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-emerald-500/20 border border-emerald-500/30 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title">{{ __('Add Student to Course') }}</h3>
                            <p class="text-sm text-slate-400 mt-1" id="addStudentCourseName"></p>
                            <form id="addStudentForm" action="{{ route('admin.course-request.add-student') }}" method="POST" class="mt-4 space-y-4">
                                @csrf
                                <input type="hidden" name="course_name" id="addStudentCourseNameInput">
                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Student Name') }} <span class="text-red-400">*</span></label>
                                    <input type="text" name="student_name" required pattern="[a-zA-Z\s]+" title="Only letters and spaces allowed" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 px-3 py-2 transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Father Name') }} <span class="text-red-400">*</span></label>
                                    <input type="text" name="father_name" required pattern="[a-zA-Z\s]+" title="Only letters and spaces allowed" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 px-3 py-2 transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Phone Number') }} <span class="text-red-400">*</span></label>
                                    <input type="tel" name="student_phone" required pattern="[0-9]+" title="Only numbers allowed" class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 px-3 py-2 transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Preferred Time') }} <span class="text-red-400">*</span></label>
                                    <input type="text" name="preferred_time" placeholder="e.g. Monday 10:00 AM" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 px-3 py-2 transition-all">
                                </div>
                                <div class="mt-4 flex justify-end gap-3">
                                    <button type="button" onclick="closeAddStudentModal()" class="px-4 py-2 bg-white/5 border border-white/10 text-slate-300 rounded-xl hover:bg-white/10 transition text-sm font-medium">{{ __('Cancel') }}</button>
                                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] transition text-sm font-medium">{{ __('Add Student') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
