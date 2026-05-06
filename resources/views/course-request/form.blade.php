<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Request a Course') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 p-4 mb-6 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-emerald-400 font-semibold">{{ __('Request Submitted Successfully!') }}</p>
                            <p class="text-emerald-400/70 text-sm mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 p-4 mb-6 rounded-xl">
                    <ul class="text-red-400 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white mb-8 shadow-[0_0_30px_rgba(59,130,246,0.3)]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-white/20 rounded-xl p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold">{{ __('Request a New Course') }}</h3>
                        <p class="text-blue-100 mt-1">{{ __('Can\'t find the course you\'re looking for? Request it here!') }}</p>
                    </div>
                </div>
                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                    <p class="text-sm text-blue-50">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Fill out the form below with your desired course details. Our admin team will review your request and contact you soon.') }}
                    </p>
                </div>
            </div>

            <!-- Request Form -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-[0_0_30px_rgba(0,0,0,0.3)] overflow-hidden">
                <form action="{{ route('course-request.submit') }}" method="POST" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Student Name (Auto-filled) -->
                        <div>
                            <label for="student_name" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Your Name') }} <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="student_name" 
                                id="student_name" 
                                value="{{ auth()->user()->name }}" 
                                required
                                readonly
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-slate-400 cursor-not-allowed"
                            >
                            <p class="text-xs text-slate-500 mt-1">{{ __('Auto-filled from your profile') }}</p>
                        </div>

                        <!-- Student Email (Auto-filled) -->
                        <div>
                            <label for="student_email" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Email Address') }} <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="student_email" 
                                id="student_email" 
                                value="{{ auth()->user()->email }}" 
                                required
                                readonly
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-slate-400 cursor-not-allowed"
                            >
                        </div>

                        <!-- Student Phone (Auto-filled) -->
                        <div>
                            <label for="student_phone" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Phone Number') }} <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="student_phone" 
                                id="student_phone" 
                                value="{{ auth()->user()->phone ?? '' }}" 
                                required
                                placeholder="{{ __('If not in profile, enter your phone') }}"
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            >
                        </div>

                        <!-- Course Name -->
                        <div>
                            <label for="course_name" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Course Name') }} <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="course_name" 
                                id="course_name" 
                                value="{{ old('course_name', request('course')) }}"
                                required
                                placeholder="{{ __('e.g., AutoCAD, Photoshop, Python') }}"
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            >
                            @error('course_name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preferred Teacher -->
                        <div>
                            <label for="preferred_teacher" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Preferred Teacher') }}
                            </label>
                            <select 
                                name="preferred_teacher" 
                                id="preferred_teacher"
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            >
                                <option value="">{{ __('Select a teacher (optional)') }}</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->name }}" {{ old('preferred_teacher') == $teacher->name ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                                <option value="custom" {{ old('preferred_teacher') == 'custom' ? 'selected' : '' }}>
                                    {{ __('Other (specify below)') }}
                                </option>
                            </select>
                        </div>

                        <!-- Custom Teacher Name -->
                        <div id="custom_teacher_field" style="display: none;">
                            <label for="custom_teacher_name" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Specify Teacher Name') }}
                            </label>
                            <input 
                                type="text" 
                                name="custom_teacher_name" 
                                id="custom_teacher_name" 
                                value="{{ old('custom_teacher_name') }}"
                                placeholder="{{ __('Enter teacher name') }}"
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            >
                        </div>

                        <!-- Preferred Time -->
                        <div>
                            <label for="preferred_time" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Preferred Time') }} <span class="text-red-400">*</span>
                            </label>
                            <select 
                                name="preferred_time" 
                                id="preferred_time" 
                                required
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            >
                                <option value="">{{ __('Select preferred time') }}</option>
                                <option value="9:00 AM" {{ old('preferred_time') == '9:00 AM' ? 'selected' : '' }}>9:00 AM</option>
                                <option value="11:00 AM" {{ old('preferred_time') == '11:00 AM' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="1:00 PM" {{ old('preferred_time') == '1:00 PM' ? 'selected' : '' }}>1:00 PM</option>
                                <option value="3:00 PM" {{ old('preferred_time') == '3:00 PM' ? 'selected' : '' }}>3:00 PM</option>
                                <option value="5:00 PM" {{ old('preferred_time') == '5:00 PM' ? 'selected' : '' }}>5:00 PM</option>
                                <option value="7:00 PM" {{ old('preferred_time') == '7:00 PM' ? 'selected' : '' }}>7:00 PM</option>
                            </select>
                            @error('preferred_time')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Message -->
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Additional Message (Optional)') }}
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="4"
                                placeholder="{{ __('Any specific requirements or questions...') }}"
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            >{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="mt-6 bg-blue-500/10 border border-blue-500/20 p-4 rounded-xl">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-400 mb-1">{{ __('What happens next?') }}</h4>
                                <ul class="text-sm text-blue-400/70 list-disc list-inside space-y-1">
                                    <li>{{ __('Your request will be sent to our admin team') }}</li>
                                    <li>{{ __('We\'ll review your request and check teacher availability') }}</li>
                                    <li>{{ __('You\'ll receive a response via email or phone within 24-48 hours') }}</li>
                                    <li>{{ __('If the course is approved, we\'ll notify you with start date and details') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            {{ __('Submit Course Request') }}
                        </button>
                        <a href="{{ route('courses.public.index') }}" class="px-8 py-4 bg-white/5 border border-white/10 text-slate-300 rounded-xl hover:bg-white/10 transition-all font-semibold">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show/hide custom teacher field
        document.getElementById('preferred_teacher').addEventListener('change', function() {
            const customField = document.getElementById('custom_teacher_field');
            if (this.value === 'custom') {
                customField.style.display = 'block';
                document.getElementById('custom_teacher_name').required = true;
            } else {
                customField.style.display = 'none';
                document.getElementById('custom_teacher_name').required = false;
            }
        });

        // Check on page load
        if (document.getElementById('preferred_teacher').value === 'custom') {
            document.getElementById('custom_teacher_field').style.display = 'block';
        }
    </script>
</x-app-layout>
