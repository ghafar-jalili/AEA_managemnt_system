<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Contact Messages') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                    <p class="text-emerald-400">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                @if($messages->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Sender') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Subject') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Date') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Status') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($messages as $message)
                                    <tr class="hover:bg-white/5 transition {{ !$message->is_read ? 'bg-blue-500/5' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-white">{{ $message->name }}</div>
                                                <div class="text-sm text-slate-400">{{ $message->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white max-w-xs truncate">{{ $message->subject }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-slate-400">{{ $message->created_at->format('M d, Y H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if(!$message->is_read)
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-400 border border-red-500/30">
                                                    {{ __('New') }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                                    {{ __('Read') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="text-blue-400 hover:text-blue-300 inline-flex items-center gap-1 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                {{ __('View') }}
                                            </a>
                                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this message?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 inline-flex items-center gap-1 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-white/10">
                        {{ $messages->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-white">{{ __('No messages') }}</h3>
                        <p class="mt-1 text-sm text-slate-400">{{ __('Contact messages will appear here.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
