<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Courses Wishlist') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 p-4 mb-6 rounded-xl">
                    <p class="text-emerald-400">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-500/10 border border-blue-500/20 p-4 mb-6 rounded-xl">
                    <p class="text-blue-400">{{ session('info') }}</p>
                </div>
            @endif

            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-8 text-white mb-8">
                <h3 class="text-3xl font-bold mb-2">{{ __('Course Wishlist') }}</h3>
                <p class="text-purple-100">{{ __('Request courses you want to learn. When 3+ students request the same course, we will start it!') }}</p>
            </div>

            @if(count($wishlistData) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($wishlistData as $wishlist)
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition-all shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-xl font-bold text-white">{{ $wishlist['course_name'] }}</h4>
                                    @if($wishlist['is_ready'])
                                        <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-xs font-bold px-3 py-1 rounded-full">
                                            {{ __('Ready to Start!') }}
                                        </span>
                                    @else
                                        <span class="bg-amber-500/20 text-amber-400 border border-amber-500/30 text-xs font-bold px-3 py-1 rounded-full">
                                            {{ __('Collecting Interest') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-slate-400 mb-1">
                                        <span>{{ __('Interested Students') }}</span>
                                        <span class="font-bold text-white">{{ $wishlist['request_count'] }}/3</span>
                                    </div>
                                    <div class="w-full bg-slate-700/50 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all" 
                                            style="width: {{ min(100, ($wishlist['request_count'] / 3) * 100) }}%"></div>
                                    </div>
                                </div>

                                <!-- Requested Times -->
                                @if(count($wishlist['preferred_times']) > 0)
                                    <div class="mb-4">
                                        <p class="text-sm text-slate-400 mb-2">{{ __('Requested Times:') }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($wishlist['preferred_times'] as $time)
                                                <span class="bg-blue-500/20 text-blue-400 border border-blue-500/30 text-xs px-2 py-1 rounded flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    {{ $time }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Request Button -->
                                <button onclick="openRequestModal('{{ $wishlist['course_name'] }}')" 
                                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-[0_0_20px_rgba(168,85,247,0.5)] text-white px-4 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6 3.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6 3.5V14"/></svg>
                                    {{ __('I Want This Course') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-12 text-center shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <svg class="mx-auto h-20 w-20 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-medium text-white">{{ __('No Course Requests Yet') }}</h3>
                    <p class="mt-2 text-sm text-slate-400">{{ __('Be the first to request a course!') }}</p>
                </div>
                <button onclick="openRequestModal('')" 
                    class="mt-6 bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-[0_0_20px_rgba(168,85,247,0.5)] text-white px-8 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    {{ __('Request a Course') }}
                </button>
            @endif
        </div>
    </div>

    <!-- Request Modal -->
    <div id="requestModal" class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-slate-900 border border-white/10 rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white">
                <h3 class="text-2xl font-bold">{{ __('Request This Course') }}</h3>
                <p class="text-purple-100 text-sm mt-1">{{ __('Fill in your details and we will contact you') }}</p>
            </div>

            <form action="{{ route('courses.request') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="course_name" id="modal_course_name">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('Course Name') }}</label>
                        <input type="text" name="course_name_display" id="course_name_display" 
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white" readonly>
                    </div>

                    <div>
                        <label for="student_name" class="block text-sm font-medium text-slate-300 mb-1">
                            {{ __('Your Name') }} <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="student_name" id="student_name" required
                            value="{{ auth()->user()->name ?? '' }}"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all">
                    </div>

                    <div>
                        <label for="student_phone" class="block text-sm font-medium text-slate-300 mb-1">
                            {{ __('Phone Number') }} <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="student_phone" id="student_phone" required
                            placeholder="07XXXXXXXX"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all">
                    </div>

                    <div>
                        <label for="preferred_time" class="block text-sm font-medium text-slate-300 mb-1">
                            {{ __('Preferred Time') }}
                        </label>
                        <select name="preferred_time" id="preferred_time"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all">
                            <option value="">{{ __('Select preferred time') }}</option>
                            <option value="9:00 AM">9:00 AM</option>
                            <option value="11:00 AM">11:00 AM</option>
                            <option value="1:00 PM">1:00 PM</option>
                            <option value="3:00 PM">3:00 PM</option>
                            <option value="5:00 PM">5:00 PM</option>
                            <option value="7:00 PM">7:00 PM</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-[0_0_20px_rgba(168,85,247,0.5)] text-white px-4 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        {{ __('Submit Request') }}
                    </button>
                    <button type="button" onclick="closeRequestModal()" 
                        class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-slate-300 rounded-xl transition-all duration-300">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRequestModal(courseName) {
            document.getElementById('modal_course_name').value = courseName;
            document.getElementById('course_name_display').value = courseName || 'Custom Course';
            document.getElementById('requestModal').classList.remove('hidden');
        }

        function closeRequestModal() {
            document.getElementById('requestModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('requestModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRequestModal();
            }
        });
    </script>
</x-app-layout>
