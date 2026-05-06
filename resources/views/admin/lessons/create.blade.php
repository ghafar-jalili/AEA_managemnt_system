<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ __('Add Lesson') }} - {{ $course->title }}
            </h2>
            <a href="{{ route('admin.lessons.index', $course) }}" class="text-blue-400 hover:text-blue-300 flex items-center gap-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                {{ __('Back to Lessons') }}
            </a>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)] p-8">
                <form action="{{ route('admin.lessons.store', $course) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Lesson Title') }} <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title') }}"
                            required
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            placeholder="{{ __('e.g., Introduction to HTML') }}"
                        >
                        @error('title')
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
                            rows="4"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            placeholder="{{ __('Brief description of this lesson') }}"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- YouTube Video ID -->
                    <div>
                        <label for="youtube_video_id" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('YouTube Video ID') }} <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="youtube_video_id" 
                            id="youtube_video_id" 
                            value="{{ old('youtube_video_id') }}"
                            required
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all font-mono"
                            placeholder="{{ __('e.g., dQw4w9WgXcQ') }}"
                        >
                        <p class="mt-2 text-xs text-slate-400">
                            <span class="text-blue-400">💡</span> <strong class="text-slate-300">{{ __('How to find:') }}</strong> {{ __('From YouTube video URL: https://www.youtube.com/watch?v=') }}<strong class="text-blue-400">dQw4w9WgXcQ</strong>
                        </p>
                        @error('youtube_video_id')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-semibold text-slate-300 mb-2">
                            {{ __('Lesson Order') }} <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="order" 
                            id="order" 
                            value="{{ old('order', $maxOrder + 1) }}"
                            min="1"
                            required
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                        >
                        <p class="mt-1 text-xs text-slate-400">{{ __('Determines the display order of lessons') }}</p>
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
                                {{ old('is_free') ? 'checked' : '' }}
                                class="w-4 h-4 bg-slate-800/50 border-white/20 rounded text-blue-500 focus:ring-blue-500/20 focus:ring-2"
                            >
                        </div>
                        <div class="ml-3">
                            <label for="is_free" class="text-sm font-semibold text-slate-300">
                                {{ __('Make this lesson FREE (accessible without enrollment)') }}
                            </label>
                            <p class="text-xs text-slate-400 mt-1">
                                {{ __('Free lessons can be watched by anyone. Paid lessons require enrollment.') }}
                            </p>
                        </div>
                    </div>
                    @error('is_free')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/10">
                        <a href="{{ route('admin.lessons.index', $course) }}" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-slate-300 rounded-xl transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            {{ __('Add Lesson') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
