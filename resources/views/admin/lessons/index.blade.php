<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ __('Lessons') }} - {{ $course->title }}
            </h2>
            <a href="{{ route('admin.lessons.create', $course) }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('Add Lesson') }}
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

            <!-- Lessons List -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                @if($lessons->count() > 0)
                    <div class="divide-y divide-white/10">
                        @foreach($lessons as $lesson)
                            <div class="p-6 hover:bg-white/5 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="bg-blue-500/20 border border-blue-500/30 rounded-xl p-3">
                                            <span class="text-blue-400 font-bold text-lg">{{ $lesson->order }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-white">{{ $lesson->title }}</h3>
                                            @if($lesson->description)
                                                <p class="text-sm text-slate-400 mt-1">{{ Str::limit($lesson->description, 100) }}</p>
                                            @endif
                                            <div class="flex items-center gap-4 mt-2 text-xs text-slate-400">
                                                <span class="font-mono text-slate-500">Video ID: {{ $lesson->youtube_video_id }}</span>
                                                @if($lesson->is_free)
                                                    <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full font-semibold">{{ __('FREE') }}</span>
                                                @else
                                                    <span class="px-2 py-1 bg-purple-500/20 text-purple-400 border border-purple-500/30 rounded-full font-semibold">{{ __('ENROLLED ONLY') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.lessons.edit', [$course, $lesson]) }}" class="text-blue-400 hover:text-blue-300 bg-blue-500/10 hover:bg-blue-500/20 px-4 py-2 rounded-xl transition-colors flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('admin.lessons.destroy', [$course, $lesson]) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this lesson?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 px-4 py-2 rounded-xl transition-colors flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-white">{{ __('No lessons yet') }}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{ __('Start adding lessons to this course.') }}</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.lessons.create', $course) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white rounded-xl transition-all duration-300 font-semibold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                {{ __('Add First Lesson') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
