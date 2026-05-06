<x-app-layout>
    <section class="relative pt-24 pb-16 overflow-hidden min-h-screen">
        {{-- Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            @if($verified)
                <!-- Certificate Found & Verified -->
                <div class="max-w-4xl mx-auto">
                    <!-- Success Header -->
                    <div class="bg-gradient-to-r from-emerald-500/20 to-teal-500/20 border border-emerald-500/30 rounded-2xl px-8 py-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="bg-emerald-500/20 rounded-2xl p-4 border border-emerald-500/30">
                                <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">{{ __('Certificate Verified!') }}</h3>
                                <p class="text-emerald-400">{{ __('This is a valid AFG Engineering Association certificate') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Certificate Details -->
                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 p-8 shadow-[0_0_60px_rgba(0,0,0,0.5)]">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-slate-900/50 p-6 rounded-xl border border-white/10">
                                <div class="text-sm text-slate-400 uppercase tracking-wide mb-2">{{ __('Certificate Number') }}</div>
                                <div class="text-xl font-bold text-blue-400 font-mono">{{ $certificate->certificate_number }}</div>
                            </div>
                            
                            <div class="bg-slate-900/50 p-6 rounded-xl border border-white/10">
                                <div class="text-sm text-slate-400 uppercase tracking-wide mb-2">{{ __('Student Name') }}</div>
                                <div class="text-xl font-bold text-white">{{ $certificate->student_name }}</div>
                            </div>
                            
                            <div class="bg-slate-900/50 p-6 rounded-xl border border-white/10">
                                <div class="text-sm text-slate-400 uppercase tracking-wide mb-2">{{ __('Course Name') }}</div>
                                <div class="text-xl font-bold text-white">{{ $certificate->course_name }}</div>
                            </div>
                            
                            <div class="bg-slate-900/50 p-6 rounded-xl border border-white/10">
                                <div class="text-sm text-slate-400 uppercase tracking-wide mb-2">{{ __('Issue Date') }}</div>
                                <div class="text-xl font-bold text-white">{{ $certificate->issue_date->format('F d, Y') }}</div>
                            </div>
                            
                            @if($certificate->start_date)
                            <div class="bg-slate-900/50 p-6 rounded-xl border border-white/10">
                                <div class="text-sm text-slate-400 uppercase tracking-wide mb-2">{{ __('Start Date') }}</div>
                                <div class="text-xl font-bold text-white">{{ $certificate->start_date->format('F d, Y') }}</div>
                            </div>
                            @endif
                            
                            <div class="bg-slate-900/50 p-6 rounded-xl border border-white/10">
                                <div class="text-sm text-slate-400 uppercase tracking-wide mb-2">{{ __('Status') }}</div>
                                <div class="flex items-center gap-2">
                                    <span class="px-4 py-2 bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 rounded-full text-lg font-semibold flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ __('Verified') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Verification Info -->
                        <div class="bg-blue-500/10 border border-blue-500/20 p-6 rounded-xl">
                            <h4 class="font-bold text-blue-400 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Verification Information') }}
                            </h4>
                            <p class="text-slate-400 text-sm">
                                {{ __('This certificate has been verified through the AFG Engineering Association official system. The certificate holder has successfully completed all requirements for the mentioned course.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Certificate Not Found -->
                <div class="max-w-4xl mx-auto">
                    <!-- Error Header -->
                    <div class="bg-gradient-to-r from-red-500/20 to-pink-500/20 border border-red-500/30 rounded-2xl px-8 py-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="bg-red-500/20 rounded-2xl p-4 border border-red-500/30">
                                <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">{{ __('Certificate Not Verified') }}</h3>
                                <p class="text-red-400">{{ $message ?? __('The certificate could not be verified') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 p-8 shadow-[0_0_60px_rgba(0,0,0,0.5)]">
                        <div class="bg-amber-500/10 border border-amber-500/20 p-6 rounded-xl mb-6">
                            <h4 class="font-bold text-amber-400 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                {{ __('Possible Reasons:') }}
                            </h4>
                            <ul class="text-slate-400 text-sm space-y-2">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                                    {{ __('The certificate number is incorrect') }}
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                                    {{ __('The certificate has not been approved by admin yet') }}
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                                    {{ __('The certificate does not exist in our system') }}
                                </li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="text-slate-400 text-sm">
                                {{ __('If you believe this is an error, please contact support.') }}
                            </p>
                            <a href="{{ route('contact') }}" class="px-4 py-2 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-500/30 text-blue-400 rounded-lg transition-colors">
                                {{ __('Contact Support') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
