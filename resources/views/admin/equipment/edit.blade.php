<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Edit Equipment') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <form action="{{ route('admin.equipment.update', $equipment) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Current Image Preview -->
                    @if($equipment->image)
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Current Image</label>
                            <div class="relative w-48 h-48">
                                <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}" class="w-full h-full object-cover rounded-xl border border-white/10">
                            </div>
                        </div>
                    @endif

                    <!-- Equipment Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">
                            Equipment Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                               class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                               placeholder="Enter equipment name"
                               value="{{ old('name', $equipment->name) }}">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Owner Name -->
                    <div>
                        <label for="owner_name" class="block text-sm font-semibold text-slate-300 mb-2">
                            Owner Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="owner_name" id="owner_name" required
                               class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                               placeholder="Enter owner name"
                               value="{{ old('owner_name', $equipment->owner_name) }}">
                        @error('owner_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-300 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                                  placeholder="Enter equipment description">{{ old('description', $equipment->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Rental Price -->
                        <div>
                            <label for="rental_price_per_month" class="block text-sm font-semibold text-slate-300 mb-2">
                                Rental Price per Month ($) <span class="text-red-400">*</span>
                            </label>
                            <input type="number" name="rental_price_per_month" id="rental_price_per_month" step="0.01" required
                                   class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                                   placeholder="0.00"
                                   value="{{ old('rental_price_per_month', $equipment->rental_price_per_month) }}">
                            @error('rental_price_per_month')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-sm font-semibold text-slate-300 mb-2">
                                Quantity <span class="text-red-400">*</span>
                            </label>
                            <input type="number" name="quantity" id="quantity" required min="1"
                                   class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                                   value="{{ old('quantity', $equipment->quantity) }}">
                            @error('quantity')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Equipment Image -->
                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-300 mb-2">
                            Equipment Image
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all file:bg-blue-600 file:text-white file:border-0 file:rounded-lg file:px-4 file:py-2 file:mr-4 hover:file:bg-blue-700">
                        <p class="text-sm text-slate-400 mt-1">Upload a new image to replace the current one (max 2MB). Leave empty to keep current image.</p>
                        @error('image')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">
                            Status <span class="text-red-400">*</span>
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
                            <option value="available" {{ old('status', $equipment->status) === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="rented" {{ old('status', $equipment->status) === 'rented' ? 'selected' : '' }}>Rented</option>
                            <option value="maintenance" {{ old('status', $equipment->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('status')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-white/10">
                        <a href="{{ route('admin.equipment.index') }}" class="px-6 py-3 bg-white/5 border border-white/10 text-slate-300 rounded-xl hover:bg-white/10 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transition-all font-semibold">
                            Update Equipment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
