<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('My Certificates') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                    <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/20 p-4 rounded-xl">
                    <p class="text-red-400 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @if($certificates->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($certificates as $certificate)
                        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-white/20 transition-all shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                            <!-- Certificate Header -->
                            <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-bold text-white">{{ __('Certificate') }}</h3>
                                    @if($certificate->is_verified)
                                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold">✓ {{ __('Approved') }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-amber-500/20 text-amber-400 border border-amber-500/30 rounded-full text-xs font-semibold">⏳ {{ __('Pending') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Certificate Body -->
                            <div class="p-6">
                                <div class="mb-4">
                                    <div class="text-sm text-slate-400 mb-1">{{ __('Course') }}</div>
                                    <div class="text-lg font-bold text-white">{{ $certificate->course_name }}</div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-sm text-slate-400 mb-1">{{ __('Certificate Number') }}</div>
                                    <div class="text-sm font-mono text-blue-400">{{ $certificate->certificate_number }}</div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-sm text-slate-400 mb-1">{{ __('Issue Date') }}</div>
                                    <div class="text-sm font-semibold text-white">{{ $certificate->issue_date->format('M d, Y') }}</div>
                                </div>

                                <!-- Actions -->
                                <div class="mt-6 space-y-2">
                                    @if($certificate->is_verified)
                                        <a href="{{ route('student.certificate.download', $certificate) }}" 
                                           class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] text-white px-4 py-3 rounded-xl font-semibold block text-center transition-all duration-300 flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            {{ __('Download PDF') }}
                                        </a>
                                        <a href="{{ route('certificate.verify', $certificate->certificate_number) }}" 
                                           class="w-full bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-4 py-3 rounded-xl font-semibold block text-center transition-all duration-300">
                                            {{ __('View Certificate') }}
                                        </a>
                                    @else
                                        <div class="bg-amber-500/10 border border-amber-500/20 p-3 rounded-xl">
                                            <p class="text-amber-400 text-sm">{{ __('Waiting for admin approval') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($certificates->hasPages())
                    <div class="mt-6">
                        {{ $certificates->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-12 text-center shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <svg class="mx-auto h-20 w-20 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-medium text-white">{{ __('No certificates yet') }}</h3>
                    <p class="mt-2 text-sm text-slate-400">{{ __('Complete a course and claim your certificate!') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
