<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Enrollment Management') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                    <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                @if($enrollments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Student') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Course') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Status') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Enrolled') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($enrollments as $enrollment)
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="text-sm font-semibold text-white">{{ $enrollment->user->name }}</div>
                                                <div class="text-sm text-slate-400">{{ $enrollment->user->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-white">{{ $enrollment->course->title }}</div>
                                            <div class="text-sm text-slate-400">{{ number_format($enrollment->course->price, 2) }} AF</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($enrollment->status === 'pending')
                                                <span class="px-3 py-1 bg-amber-500/20 text-amber-400 border border-amber-500/30 rounded-full text-xs font-semibold">{{ __('Pending') }}</span>
                                            @elseif($enrollment->status === 'approved')
                                                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold">{{ __('Approved') }}</span>
                                            @elseif($enrollment->status === 'rejected')
                                                <span class="px-3 py-1 bg-red-500/20 text-red-400 border border-red-500/30 rounded-full text-xs font-semibold">{{ __('Rejected') }}</span>
                                            @elseif($enrollment->status === 'completed')
                                                <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-full text-xs font-semibold">{{ __('Completed') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-slate-400">{{ $enrollment->enrolled_at->format('M d, Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($enrollment->status === 'pending')
                                                <div class="flex gap-2">
                                                    <form action="{{ route('admin.enrollments.approve', $enrollment) }}" method="POST" class="inline">
                                                        @csrf
                                                        <input type="hidden" name="admin_notes" value="Approved by admin">
                                                        <button type="submit" class="bg-emerald-600 hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] text-white px-4 py-2 rounded-xl transition-all text-sm font-semibold">
                                                            {{ __('Approve') }}
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.enrollments.reject', $enrollment) }}" method="POST" class="inline">
                                                        @csrf
                                                        <input type="hidden" name="admin_notes" value="Rejected by admin">
                                                        <button type="submit" class="bg-red-600 hover:shadow-[0_0_20px_rgba(239,68,68,0.5)] text-white px-4 py-2 rounded-xl transition-all text-sm font-semibold" onclick="return confirm('{{ __('Reject this enrollment?') }}')">
                                                            {{ __('Reject') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-sm text-slate-500">{{ __('No action needed') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($enrollments->hasPages())
                        <div class="bg-white/5 px-6 py-4 border-t border-white/10">
                            {{ $enrollments->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <p class="text-slate-400">{{ __('No enrollments found.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
