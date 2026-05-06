<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Reports & Analytics') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-[0_0_30px_rgba(59,130,246,0.3)]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">{{ __('Total Users') }}</p>
                            <p class="text-4xl font-bold mt-2">{{ $totalUsers }}</p>
                        </div>
                        <svg class="w-14 h-14 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-[0_0_30px_rgba(16,185,129,0.3)]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm">{{ __('Total Courses') }}</p>
                            <p class="text-4xl font-bold mt-2">{{ $totalCourses }}</p>
                        </div>
                        <svg class="w-14 h-14 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-[0_0_30px_rgba(168,85,247,0.3)]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm">{{ __('Total Enrollments') }}</p>
                            <p class="text-4xl font-bold mt-2">{{ $totalEnrollments }}</p>
                        </div>
                        <svg class="w-14 h-14 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl p-6 text-white shadow-[0_0_30px_rgba(244,63,94,0.3)]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-rose-100 text-sm">{{ __('Certificates Issued') }}</p>
                            <p class="text-4xl font-bold mt-2">{{ $totalCertificates }}</p>
                        </div>
                        <svg class="w-14 h-14 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Monthly Enrollments -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <h4 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        {{ __('Monthly Enrollments (Last 12 Months)') }}
                    </h4>
                    <div class="h-48">
                        <canvas id="enrollmentsChart"></canvas>
                    </div>
                </div>

                <!-- Users by Role -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <h4 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        {{ __('Users by Role') }}
                    </h4>
                    <div class="h-48">
                        <canvas id="usersByRoleChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Enrollments by Status -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <h4 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        {{ __('Enrollments by Status') }}
                    </h4>
                    <div class="h-48">
                        <canvas id="enrollmentsStatusChart"></canvas>
                    </div>
                </div>

                <!-- Certificates by Status -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <h4 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('Certificates by Status') }}
                    </h4>
                    <div class="h-48">
                        <canvas id="certificatesStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top Courses -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <h4 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    {{ __('Top 10 Courses by Enrollment') }}
                </h4>
                <div class="space-y-4">
                    @foreach($topCourses as $index => $course)
                        <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-slate-800/50 to-slate-700/50 rounded-xl hover:border-white/20 border border-white/5 transition-all">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <h5 class="font-bold text-white">{{ $course->title }}</h5>
                                <p class="text-sm text-slate-400">{{ $course->teacher_name }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-bold text-blue-400">{{ $course->enrollments_count }}</span>
                                <p class="text-xs text-slate-500">{{ __('students') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Courses by Teacher -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <h4 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    {{ __('Courses by Teacher') }}
                </h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="bg-white/5">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Teacher') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Total Courses') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @foreach($coursesByTeacher as $teacher)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-6 py-4 font-semibold text-white">{{ $teacher->teacher_name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-full font-semibold">
                                            {{ $teacher->count }} {{ __('courses') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <h4 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('Recent Activity (Last 20 Enrollments)') }}
                </h4>
                <div class="space-y-3 max-h-[400px] overflow-y-auto">
                    @foreach($recentActivity as $activity)
                        <div class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-xl transition-all border-l-4 {{ $activity->status === 'approved' ? 'border-emerald-500' : ($activity->status === 'pending' ? 'border-amber-500' : 'border-red-500') }}">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 shadow-lg">
                                {{ strtoupper(substr($activity->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-white truncate">{{ $activity->user->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ $activity->course->title }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $activity->status === 'approved' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : ($activity->status === 'pending' ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30') }}">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Enrollments Chart
        new Chart(document.getElementById('enrollmentsChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyEnrollments->map(function($item) {
                    return date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year));
                })) !!},
                datasets: [{
                    label: 'Enrollments',
                    data: {!! json_encode($monthlyEnrollments->pluck('count')) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Users by Role Chart
        new Chart(document.getElementById('usersByRoleChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($usersByRole)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($usersByRole)) !!},
                    backgroundColor: ['rgba(59, 130, 246, 0.8)', 'rgba(34, 197, 94, 0.8)', 'rgba(168, 85, 247, 0.8)']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        // Enrollments Status Chart
        new Chart(document.getElementById('enrollmentsStatusChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($enrollmentsByStatus)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($enrollmentsByStatus)) !!},
                    backgroundColor: ['rgba(34, 197, 94, 0.8)', 'rgba(234, 179, 8, 0.8)', 'rgba(239, 68, 68, 0.8)', 'rgba(59, 130, 246, 0.8)']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });

        // Certificates Status Chart
        new Chart(document.getElementById('certificatesStatusChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($certificatesByStatus)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($certificatesByStatus)) !!},
                    backgroundColor: ['rgba(34, 197, 94, 0.8)', 'rgba(239, 68, 68, 0.8)', 'rgba(234, 179, 8, 0.8)']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    </script>
</x-app-layout>
