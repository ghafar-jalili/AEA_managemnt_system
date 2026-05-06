<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ __('Edit User: ') . $user->name }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-blue-400 hover:text-blue-300 flex items-center gap-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                {{ __('Back to Users') }}
            </a>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 p-4 mb-6 rounded-xl">
                    <p class="text-emerald-400">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 p-4 mb-6 rounded-xl">
                    <ul class="text-red-400 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <!-- User Profile Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
                    <div class="flex items-center gap-6">
                        <div class="flex-shrink-0">
                            @if($user->photo)
                                <img class="h-24 w-24 rounded-full object-cover border-4 border-white" src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}">
                            @else
                                <div class="h-24 w-24 rounded-full bg-white/20 flex items-center justify-center text-white text-3xl font-bold border-4 border-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                            <p class="text-blue-100">{{ $user->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 bg-white/20 rounded-full text-sm">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Full Name') }} <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $user->name) }}" 
                                required
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                        </div>

                        <!-- Father Name -->
                        <div>
                            <label for="father_name" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Father Name') }}
                            </label>
                            <input 
                                type="text" 
                                name="father_name" 
                                id="father_name" 
                                value="{{ old('father_name', $user->father_name) }}"
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Email Address') }} <span class="text-red-400">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email', $user->email) }}" 
                                required
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Phone Number') }}
                            </label>
                            <input 
                                type="text" 
                                name="phone" 
                                id="phone" 
                                value="{{ old('phone', $user->phone) }}"
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('User Role') }} <span class="text-red-400">*</span>
                            </label>
                            <select 
                                name="role" 
                                id="role" 
                                required
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                                <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>{{ __('Student') }}</option>
                                <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>{{ __('Teacher') }}</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                            </select>
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('Profile Photo') }}
                            </label>
                            <input 
                                type="file" 
                                name="photo" 
                                id="photo" 
                                accept="image/*"
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                            <p class="text-xs text-slate-400 mt-1">{{ __('Max size: 2MB. Formats: JPEG, PNG, JPG, GIF') }}</p>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                {{ __('New Password') }} <span class="text-xs text-slate-400">({{ __('leave blank to keep current') }})</span>
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                            >
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-8 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ __('Save Changes') }}
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="bg-slate-700/50 hover:bg-slate-700 text-slate-300 px-8 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            {{ __('Cancel') }}
                        </a>
                        @if($user->id !== auth()->id())
                            </form><form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:shadow-[0_0_30px_rgba(239,68,68,0.5)] text-white px-8 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                {{ __('Delete User') }}
                            </button>
                            </form>
                        @else
                    </div>
                </form>
                        @endif
            </div>

            <!-- User Information Card -->
            <!-- User Information Card -->
<div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)] mt-6 transition-all duration-300 hover:shadow-[0_0_40px_rgba(0,0,0,0.4)] hover:border-white/20">
    <div class="p-6 border-b border-white/10">
        <h4 class="text-xl font-bold text-white flex items-center gap-2">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            {{ __('User Activity') }}
        </h4>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Enrollments --}}
            <div class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 rounded-xl border border-slate-700/50 p-5 transition-all duration-300 hover:border-blue-500/50 hover:shadow-lg hover:shadow-blue-500/10 cursor-pointer overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/5 to-blue-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-slate-300">{{ __('Enrollments') }}</span>
                        </div>
                        <div class="px-2 py-1 bg-blue-500/10 rounded-lg border border-blue-500/20">
                            <span class="text-xs font-semibold text-blue-400">Active</span>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <span class="text-4xl font-bold text-white">{{ $user->enrollments()->count() }}</span>
                        <span class="text-slate-400 ml-2">courses</span>
                    </div>
                    
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Total registered courses</span>
                    </div>
                </div>
            </div>

            {{-- Certificates --}}
            <div class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 rounded-xl border border-slate-700/50 p-5 transition-all duration-300 hover:border-emerald-500/50 hover:shadow-lg hover:shadow-emerald-500/10 cursor-pointer overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/0 via-emerald-500/5 to-emerald-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.587 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.587 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.587 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.587 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-slate-300">{{ __('Certificates') }}</span>
                        </div>
                        <div class="px-2 py-1 bg-emerald-500/10 rounded-lg border border-emerald-500/20">
                            <span class="text-xs font-semibold text-emerald-400">{{ $user->certificates()->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <span class="text-4xl font-bold text-white">{{ $user->certificates()->count() }}</span>
                        <span class="text-slate-400 ml-2">earned</span>
                    </div>
                    
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Professional certifications</span>
                    </div>
                </div>
            </div>

            {{-- Courses Teaching --}}
            <div class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 rounded-xl border border-slate-700/50 p-5 transition-all duration-300 hover:border-purple-500/50 hover:shadow-lg hover:shadow-purple-500/10 cursor-pointer overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-purple-500/5 to-purple-500/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-xl bg-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-slate-300">{{ __('Teaching') }}</span>
                        </div>
                        <div class="px-2 py-1 bg-purple-500/10 rounded-lg border border-purple-500/20">
                            <span class="text-xs font-semibold text-purple-400">Instructor</span>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <span class="text-4xl font-bold text-white">{{ $user->courses()->count() }}</span>
                        <span class="text-slate-400 ml-2">courses</span>
                    </div>
                    
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Active courses you teach</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Account Information Footer --}}
    <div class="border-t border-white/10 bg-slate-900/30 px-6 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-400">{{ __('Account Created') }}</p>
                    <p class="text-sm font-medium text-white">{{ $user->created_at->format('F d, Y h:i A') }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-400">{{ __('Last Updated') }}</p>
                    <p class="text-sm font-medium text-white">{{ $user->updated_at->format('F d, Y h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
