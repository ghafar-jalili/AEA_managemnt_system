<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content: Video Player -->
                <div class="lg:col-span-2">
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                        <!-- YouTube Video Embed -->
                        <div class="aspect-w-16 aspect-h-9 bg-black">
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $lesson->youtube_video_id }}?rel=0&modestbranding=1&showinfo=0" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" 
                                allowfullscreen
                                class="w-full h-[500px]"
                            ></iframe>
                        </div>

                        <!-- Lesson Info -->
                        <div class="p-8">
                            <h1 class="text-3xl font-bold text-white mb-4">{{ $lesson->title }}</h1>
                            
                            @if($lesson->description)
                                <div class="prose max-w-none">
                                    <p class="text-slate-300 leading-relaxed whitespace-pre-line">{{ $lesson->description }}</p>
                                </div>
                            @endif

                            <!-- Navigation Buttons -->
                            <div class="flex items-center justify-between mt-8 pt-6 border-t border-white/10">
                                @if($previousLesson)
                                    <a href="{{ route('student.lesson.show', [$course, $previousLesson]) }}" class="flex items-center gap-2 px-6 py-3 bg-slate-700/50 text-slate-300 rounded-xl hover:bg-slate-700 transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                        {{ __('Previous Lesson') }}
                                    </a>
                                @else
                                    <div></div>
                                @endif

                                @if($nextLesson)
                                    <a href="{{ route('student.lesson.show', [$course, $nextLesson]) }}" class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] text-white rounded-xl transition-all duration-300">
                                        {{ __('Next Lesson') }}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Lesson List -->
                <div class="lg:col-span-1">
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden sticky top-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                        <div class="p-6 border-b border-white/10">
                            <h3 class="text-lg font-bold text-white">{{ __('Course Content') }}</h3>
                            <p class="text-sm text-slate-400 mt-1">{{ $lessons->count() }} {{ __('lessons') }}</p>
                        </div>

                        <div class="divide-y divide-white/10 max-h-[600px] overflow-y-auto">
                            @foreach($lessons as $index => $l)
                                @if($l->id === $lesson->id)
                                    <!-- Current Lesson -->
                                    <div class="p-4 bg-blue-500/10 border-l-4 border-blue-500">
                                        <div class="flex items-start gap-3">
                                            <div class="bg-blue-500 rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-white">{{ $l->order }}. {{ $l->title }}</p>
                                                <p class="text-xs text-blue-400 mt-1">{{ __('Currently Watching') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Other Lessons -->
                                    <a href="{{ route('student.lesson.show', [$course, $l]) }}" class="p-4 hover:bg-white/5 transition block">
                                        <div class="flex items-start gap-3">
                                            <div class="bg-slate-700/50 rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0">
                                                <span class="text-xs font-semibold text-slate-400">{{ $l->order }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-white">{{ $l->order }}. {{ $l->title }}</p>
                                                @if($l->is_free)
                                                    <span class="text-xs text-emerald-400 mt-1 inline-block">{{ __('FREE') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
