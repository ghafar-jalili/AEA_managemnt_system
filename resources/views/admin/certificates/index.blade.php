<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Certificate Management') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Certificate Verification -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-[0_0_30px_rgba(59,130,246,0.3)] p-8 mb-8 text-white">
                <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    {{ __('Verify Certificate') }}
                </h3>
                <form action="{{ route('certificate.verify', ['certificateNumber' => 'PLACEHOLDER']) }}" method="GET" id="verifyForm" class="flex gap-4">
                    <input type="text" id="certificateNumber" placeholder="{{ __('Enter Certificate Number (e.g., AFG-2026-XXXXX)') }}" 
                           class="flex-1 px-6 py-3 rounded-xl text-slate-900 font-semibold focus:outline-none focus:ring-4 focus:ring-white/50"
                           required>
                    <button type="submit" class="bg-white text-blue-600 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('Verify Now') }}
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                    <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                @if($certificates->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Certificate #') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Student') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Course') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Status') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Issue Date') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($certificates as $certificate)
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-mono font-semibold text-blue-400">{{ $certificate->certificate_number }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="text-sm font-semibold text-white">{{ $certificate->student_name }}</div>
                                                <div class="text-sm text-slate-400">{{ $certificate->user->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-white">{{ $certificate->course_name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($certificate->is_verified)
                                                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    {{ __('Approved') }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-amber-500/20 text-amber-400 border border-amber-500/30 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0"/></svg>
                                                    {{ __('Pending') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-slate-400">{{ $certificate->issue_date->format('M d, Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if(!$certificate->is_verified)
                                                <div class="flex gap-2">
                                                    <form action="{{ route('admin.certificates.approve', $certificate) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-emerald-600 hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] text-white px-4 py-2 rounded-xl transition-all text-sm font-semibold">
                                                            {{ __('Approve') }}
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.certificates.reject', $certificate) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-red-600 hover:shadow-[0_0_20px_rgba(239,68,68,0.5)] text-white px-4 py-2 rounded-xl transition-all text-sm font-semibold" onclick="return confirm('{{ __('Reject this certificate?') }}')">
                                                            {{ __('Reject') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-sm text-emerald-400 font-semibold flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    {{ __('Active') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($certificates->hasPages())
                        <div class="bg-white/5 px-6 py-4 border-t border-white/10">
                            {{ $certificates->links() }}
                        </div>
                    @endif
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-white">{{ __('No certificate requests yet') }}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{ __('Certificate requests will appear here when students complete courses.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('certificateNumber').addEventListener('input', function(e) {
            const form = document.getElementById('verifyForm');
            const value = e.target.value;
            form.action = form.action.replace('PLACEHOLDER', value);
        });
    </script>
</x-app-layout>
