<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ __('Equipment Management') }}
            </h2>
            <a href="{{ route('admin.equipment.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('Add Equipment') }}
            </a>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">{{ __('Available Equipment') }}</p>
                            <p class="text-3xl font-bold text-emerald-400">{{ $availableCount }}</p>
                        </div>
                        <div class="w-14 h-14 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">{{ __('Rented Equipment') }}</p>
                            <p class="text-3xl font-bold text-orange-400">{{ $rentedCount }}</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-500/20 border border-orange-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm">{{ __('Total Revenue') }}</p>
                            <p class="text-3xl font-bold text-blue-400">{{ number_format($totalRevenue, 2) }} AF</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Equipment Grid -->
            <div class="mb-6">
                <h3 class="text-xl font-bold text-white mb-6">{{ __('All Equipment') }}</h3>

                @forelse($equipment as $item)
                    <div class="group bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden hover:border-blue-500/30 transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(59,130,246,0.15)] mb-6">
                        <div class="flex flex-col lg:flex-row">
                            <!-- Image Section -->
                            <div class="relative flex-shrink-0 overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 min-h-[200px]" style="width: 200px !important; min-width: 200px !important; max-width: 200px !important;">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center hidden">
                                        <svg class="w-20 h-20 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Status Badge -->
                                <div class="absolute top-3 left-3">
                                    @if($item->status === 'available')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/30">
                                            {{ __('Available') }}
                                        </span>
                                    @elseif($item->status === 'rented')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-orange-500 text-white shadow-lg shadow-orange-500/30">
                                            {{ __('Rented') }}
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-500 text-white shadow-lg shadow-red-500/30">
                                            {{ __('Maintenance') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="flex-1 p-5 lg:p-6 flex flex-col justify-between">
                                <!-- Header -->
                                <div class="mb-4">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-3 mb-3">
                                        <div class="flex-1">
                                            <h4 class="text-lg font-bold text-white mb-1 group-hover:text-blue-400 transition-colors">{{ $item->name }}</h4>
                                            <div class="flex items-center gap-2 text-slate-400 text-sm">
                                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <span>{{ $item->owner_name }}</span>
                                            </div>
                                        </div>
                                        <div class="text-left lg:text-right">
                                            <div class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                                {{ number_format($item->rental_price_per_month, 2) }} AF
                                            </div>
                                            <div class="text-xs text-slate-500">{{ __('per month') }}</div>
                                        </div>
                                    </div>
                                    <p class="text-slate-400 text-sm line-clamp-2 leading-relaxed">
                                        {{ $item->description ?? __('No description available.') }}
                                    </p>
                                </div>

                                <!-- Stats Row -->
                                <div class="flex flex-wrap items-center gap-4 mb-4 py-3 border-y border-white/5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-500">{{ __('Quantity') }}</div>
                                            <div class="text-sm font-semibold text-white">{{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-500">{{ __('Revenue') }}</div>
                                            <div class="text-sm font-semibold text-emerald-400">{{ number_format($item->rental_price_per_month * $item->quantity, 2) }} AF</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-slate-500">{{ __('Added') }}</div>
                                            <div class="text-sm font-medium text-white">{{ $item->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.equipment.edit', $item) }}" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg transition-all font-medium flex items-center justify-center gap-2 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('admin.equipment.destroy', $item) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-slate-700 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all font-medium flex items-center justify-center gap-2 text-sm" onclick="return confirm('{{ __('Are you sure you want to delete this equipment?') }}')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="mt-4 text-slate-400 text-lg">{{ __('No equipment found.') }}</p>
                        <a href="{{ route('admin.equipment.create') }}" class="mt-4 inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Add Your First Equipment') }}
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($equipment->hasPages())
                <div class="mt-8">
                    {{ $equipment->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
