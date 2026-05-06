<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative pt-24 pb-16 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-slate-950">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="container-premium relative z-10">
            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto mb-16" data-animate="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-xl rounded-full text-blue-400 text-sm font-medium border border-white/10 mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Equipment') }}
                </div>
                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4 tracking-tight">
                    {{ __('Available') }} 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">{{ __('Equipment') }}</span>
                </h1>
                <p class="text-lg text-slate-400">
                    {{ __('Browse our collection of professional engineering equipment available for student use.') }}
                </p>
            </div>

            @if($equipment->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-animate="fade-up">
                    @foreach($equipment as $item)
                    <div class="group relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_60px_rgba(59,130,246,0.15)] flex flex-col h-full">
                        <!-- Equipment Image -->
                        <div class="mb-4 h-40 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl overflow-hidden mx-6 mt-6 relative">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <h4 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors">{{ $item->name }}</h4>
                                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold">
                                    {{ __('Available') }}
                                </span>
                            </div>
                            <div class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-4">
                                {{ number_format($item->rental_price_per_month, 2) }} AF
                                <span class="text-sm text-slate-500 font-normal">{{ __('/ month') }}</span>
                            </div>
                            @if($item->description)
                                <p class="text-sm text-slate-400 mb-4 flex-1">{{ $item->description }}</p>
                            @else
                                <div class="flex-1"></div>
                            @endif
                            <div class="flex flex-col gap-3 mt-auto pt-4 border-t border-white/10">
                                @if($item->quantity > 0)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        <p class="text-sm text-slate-400 font-medium">{{ __('Quantity') }}: <span class="text-blue-400 font-bold">{{ $item->quantity }}</span></p>
                                    </div>
                                @endif
                                @auth
                                    <button type="button" onclick="openRentModal('{{ $item->name }}')" class="w-full py-2.5 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-300 hover:shadow-blue-500/40 hover:scale-[1.02] flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('RENT') }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="w-full py-2.5 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-300 hover:shadow-blue-500/40 hover:scale-[1.02] flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Login to Rent') }}
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Rent Modal -->
                <div id="rentModal" class="fixed inset-0 z-[9999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeRentModal()"></div>
                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="flex min-h-full items-center justify-center p-4">
                            <div class="relative transform overflow-hidden rounded-2xl bg-slate-900 border border-white/10 shadow-2xl transition-all w-full max-w-md">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h3 class="text-xl font-bold text-white" id="modal-title">{{ __('Rent Equipment') }}</h3>
                                        <button type="button" onclick="closeRentModal()" class="text-slate-400 hover:text-white transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-sm text-slate-400 mb-4">{{ __('You are requesting to rent:') }} <span id="modalEquipmentName" class="text-blue-400 font-semibold"></span></p>
                                    <form method="POST" action="{{ route('equipment.rent') }}" class="space-y-4">
                                        @csrf
                                        <input type="hidden" name="equipment_name" id="modalEquipmentInput">
                                        <div>
                                            <label for="rent-name" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Full Name') }}</label>
                                            <input type="text" name="name" id="rent-name" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all" placeholder="{{ __('Enter your full name') }}">
                                        </div>
                                        <div>
                                            <label for="rent-email" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Email Address') }}</label>
                                            <input type="email" name="email" id="rent-email" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all" placeholder="{{ __('Enter your email') }}">
                                        </div>
                                        <div>
                                            <label for="rent-mobile" class="block text-sm font-medium text-slate-300 mb-1">{{ __('Mobile Number') }}</label>
                                            <input type="tel" name="mobile" id="rent-mobile" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all" placeholder="{{ __('Enter your mobile number') }}">
                                        </div>
                                        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/25 transition-all duration-300 hover:shadow-blue-500/40 hover:scale-[1.02] flex items-center justify-center gap-2 mt-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                            </svg>
                                            {{ __('Submit Request') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function openRentModal(equipmentName) {
                        document.getElementById('modalEquipmentName').textContent = equipmentName;
                        document.getElementById('modalEquipmentInput').value = equipmentName;
                        document.getElementById('rentModal').classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }
                    function closeRentModal() {
                        document.getElementById('rentModal').classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                </script>
            @else
                <div class="text-center py-16" data-animate="fade-up">
                    <div class="w-24 h-24 mx-auto bg-white/5 rounded-2xl flex items-center justify-center mb-6 border border-white/10">
                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ __('No equipment available') }}</h3>
                    <p class="text-slate-400">{{ __('Check back later for available equipment.') }}</p>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
