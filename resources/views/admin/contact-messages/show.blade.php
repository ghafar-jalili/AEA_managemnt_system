<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ $message->subject }}
            </h2>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-400 hover:text-blue-300 flex items-center gap-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                {{ __('Back to Messages') }}
            </a>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)] p-8">
                <!-- Message Header -->
                <div class="border-b border-white/10 pb-6 mb-6">
                    <h3 class="text-2xl font-bold text-white mb-4">{{ $message->subject }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-slate-400">{{ __('From:') }}</label>
                            <p class="text-lg font-semibold text-white">{{ $message->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-400">{{ __('Email:') }}</label>
                            <p class="text-lg font-semibold text-white">{{ $message->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-400">{{ __('Received:') }}</label>
                            <p class="text-white">{{ $message->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-400">{{ __('Status:') }}</label>
                            <p>
                                @if($message->is_read)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                        {{ __('Read') }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/20 text-red-400 border border-red-500/30">
                                        {{ __('New') }}
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div class="mb-6">
                    <label class="text-sm font-medium text-slate-400 mb-2 block">{{ __('Message:') }}</label>
                    <div class="bg-slate-800/50 border border-white/10 rounded-xl p-6">
                        <p class="text-white whitespace-pre-line leading-relaxed">{{ $message->message }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-6 border-t border-white/10">
                    <a href="mailto:{{ $message->email }}" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl text-center font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ __('Reply via Email') }}
                    </a>
                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this message?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:shadow-[0_0_30px_rgba(239,68,68,0.5)] text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            {{ __('Delete Message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
