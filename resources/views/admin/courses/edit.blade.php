<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Course Title') }} <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $course->title) }}"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="{{ __('Enter course title') }}"
                        >
                        @error('title')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teacher Name -->
                    <div>
                        <label for="teacher_name" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Teacher Name') }} <span class="text-red-400">*</span>
                        </label>
                        <select 
                            name="teacher_name" 
                            id="teacher_name" 
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                        >
                            <option value="">{{ __('Select a teacher') }}</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->name }}" {{ old('teacher_name', $course->teacher_name) === $teacher->name ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Description') }}
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="5"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="{{ __('Enter course description') }}"
                        >{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course Time -->
                    <div>
                        <label for="course_time" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Course Time') }} <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="course_time" 
                            id="course_time" 
                            value="{{ old('course_time', $course->course_time) }}"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="{{ __('e.g., Mon/Wed/Fri 10:00-12:00') }}"
                        >
                        <p class="mt-1 text-xs text-slate-400">{{ __('Enter the days and time when this course will be held') }}</p>
                        @error('course_time')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Price (AF)') }} <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ old('price', $course->price) }}"
                            step="0.01"
                            min="0"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="0.00"
                        >
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- YouTube Playlist ID -->
                    <div>
                        <label for="youtube_playlist_id" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('YouTube Playlist ID') }}
                        </label>
                        <input 
                            type="text" 
                            name="youtube_playlist_id" 
                            id="youtube_playlist_id" 
                            value="{{ old('youtube_playlist_id', $course->youtube_playlist_id) }}"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="{{ __('Enter YouTube playlist ID (optional)') }}"
                        >
                        <p class="mt-1 text-xs text-slate-500">{{ __('You can find this in the YouTube playlist URL') }}</p>
                        @error('youtube_playlist_id')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Course Thumbnail') }}
                        </label>
                        @if($course->thumbnail && file_exists(storage_path('app/public/' . $course->thumbnail)))
                            <div class="mb-4">
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-48 h-32 object-cover rounded-xl border border-white/20 shadow-lg">
                                <p class="mt-2 text-xs text-slate-500">{{ __('Current thumbnail') }}</p>
                            </div>
                        @endif
                        <div id="thumbnail-preview" class="hidden mb-4">
                            <img id="preview-image" src="" alt="New Preview" class="w-48 h-32 object-cover rounded-xl border border-white/20 shadow-lg">
                            <p class="mt-2 text-xs text-slate-500">{{ __('New thumbnail preview') }}</p>
                        </div>
                        <input 
                            type="file" 
                            name="thumbnail" 
                            id="thumbnail" 
                            accept="image/*"
                            onchange="previewThumbnail(this)"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all"
                        >
                        <p class="mt-1 text-xs text-slate-500">{{ __('Upload a new image to replace the current one. Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)') }}</p>
                        @error('thumbnail')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Status') }} <span class="text-red-400">*</span>
                        </label>
                        <select 
                            name="status" 
                            id="status" 
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                        >
                            <option value="active" {{ old('status', $course->status) === 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="inactive" {{ old('status', $course->status) === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                            <option value="will_start_soon" {{ old('status', $course->status) === 'will_start_soon' ? 'selected' : '' }}>{{ __('Will Start Soon') }}</option>
                        </select>
                        <p class="mt-1 text-xs text-slate-500">
                            <strong class="text-emerald-400">{{ __('Active:') }}</strong> {{ __('Course is live') }} | 
                            <strong class="text-red-400">{{ __('Inactive:') }}</strong> {{ __('Course is hidden') }} | 
                            <strong class="text-amber-400">{{ __('Will Start Soon:') }}</strong> {{ __('Course created but not started yet') }}
                        </p>
                        @error('status')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/10">
                        <a href="{{ route('admin.courses.index') }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 rounded-xl transition-colors">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02]">
                            {{ __('Update Course') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewThumbnail(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('thumbnail-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
