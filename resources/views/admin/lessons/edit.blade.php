<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Edit Lesson') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <form action="{{ route('admin.lessons.update', [$course, $lesson]) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">
                            Lesson Title <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $lesson->title) }}"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="e.g., Introduction to HTML"
                        >
                        @error('title')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">
                            Description
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                            placeholder="Brief description of this lesson"
                        >{{ old('description', $lesson->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- YouTube Video ID -->
                    <div>
                        <label for="youtube_video_id" class="block text-sm font-semibold text-slate-300 mb-2">
                            YouTube Video ID <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            name="youtube_video_id"
                            id="youtube_video_id"
                            value="{{ old('youtube_video_id', $lesson->youtube_video_id) }}"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all font-mono"
                            placeholder="e.g., dQw4w9WgXcQ"
                        >
                        <p class="mt-2 text-xs text-slate-400">
                            <span class="text-blue-400">How to find:</span> From YouTube video URL: https://www.youtube.com/watch?v=<strong class="text-white">dQw4w9WgXcQ</strong>
                        </p>
                        @error('youtube_video_id')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-semibold text-slate-300 mb-2">
                            Lesson Order <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="number"
                            name="order"
                            id="order"
                            value="{{ old('order', $lesson->order) }}"
                            min="1"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                        >
                        <p class="mt-1 text-xs text-slate-400">Determines the display order of lessons</p>
                        @error('order')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Free -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                type="checkbox"
                                name="is_free"
                                id="is_free"
                                value="1"
                                {{ old('is_free', $lesson->is_free) ? 'checked' : '' }}
                                class="w-4 h-4 border-white/30 rounded bg-slate-900/50 text-blue-500 focus:ring-blue-500/20 focus:ring-2"
                            >
                        </div>
                        <div class="ml-3">
                            <label for="is_free" class="text-sm font-semibold text-slate-300">
                                Make this lesson FREE (accessible without enrollment)
                            </label>
                            <p class="text-xs text-slate-400 mt-1">
                                Free lessons can be watched by anyone. Paid lessons require enrollment.
                            </p>
                        </div>
                    </div>
                    @error('is_free')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/10">
                        <a href="{{ route('admin.lessons.index', $course) }}" class="px-6 py-3 bg-white/5 border border-white/10 text-slate-300 rounded-xl hover:bg-white/10 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold">
                            Update Lesson
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
