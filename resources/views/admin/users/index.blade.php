<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white">
                {{ __('User Management') }}
            </h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    {{ __('Add New User') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Total Users') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $stats['total'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Students') }}</p>
                            <p class="text-3xl font-bold text-emerald-400">{{ $stats['students'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Teachers') }}</p>
                            <p class="text-3xl font-bold text-purple-400">{{ $stats['teachers'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-500/20 border border-purple-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:border-white/20 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-400 mb-1">{{ __('Admins') }}</p>
                            <p class="text-3xl font-bold text-red-400">{{ $stats['admins'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-red-500/20 border border-red-500/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="{{ __('Search by name, email, phone, or father name...') }}" 
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                        >
                    </div>
                    <div class="md:w-48">
                        <select 
                            name="role" 
                            class="w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                        >
                            <option value="">{{ __('All Roles') }}</option>
                            <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>{{ __('Student') }}</option>
                            <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>{{ __('Teacher') }}</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            {{ __('Search') }}
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-300 rounded-xl transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            {{ __('Reset') }}
                        </a>
                    </div>
                </form>
            </div>

            <!-- Users Table -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                @if($users->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-white/5">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('User') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Contact') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Role') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Activity') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Joined') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($users as $user)
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($user->photo)
                                                        <img class="h-10 w-10 rounded-full object-cover border border-white/20" src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}">
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold border border-white/20">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                                    @if($user->father_name)
                                                        <div class="text-sm text-slate-500">F: {{ $user->father_name }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-slate-300">{{ $user->email }}</div>
                                            @if($user->phone)
                                                <div class="text-sm text-slate-500">{{ $user->phone }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $user->role === 'admin' ? 'bg-red-500/20 text-red-400 border border-red-500/30' : '' }}
                                                {{ $user->role === 'teacher' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/30' : '' }}
                                                {{ $user->role === 'student' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : '' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                                            <div>{{ $user->enrollments_count }} {{ __('enrollments') }}</div>
                                            <div>{{ $user->certificates_count }} {{ __('certificates') }}</div>
                                            @if($user->courses_count > 0)
                                                <div>{{ $user->courses_count }} {{ __('courses') }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-400 hover:text-blue-300 mr-3 flex items-center gap-1 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                {{ __('Edit') }}
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 flex items-center gap-1 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-white/5 border-t border-white/10">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <p class="text-slate-400 text-lg">{{ __('No users found') }}</p>
                        @if(request('search') || request('role'))
                            <p class="text-slate-500 text-sm mt-2">{{ __('Try adjusting your search or filters') }}</p>
                        @else
                            <a href="{{ route('admin.users.create') }}" class="inline-block mt-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                {{ __('Add Your First User') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
