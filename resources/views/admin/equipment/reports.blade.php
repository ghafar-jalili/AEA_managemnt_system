<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('Equipment Reports') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('Monthly Revenue (Last 6 Months)') }}</h3>
                    <canvas id="revenueChart"></canvas>
                </div>

                <!-- Equipment Status Chart -->
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('Equipment Status Distribution') }}</h3>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Top Equipment Chart -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <h3 class="text-xl font-bold text-white mb-4">{{ __('Top 5 Most Rented Equipment') }}</h3>
                <canvas id="topEquipmentChart" height="100"></canvas>
            </div>

            <!-- Active Rentals Table -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                <div class="p-6 border-b border-white/10">
                    <h3 class="text-xl font-bold text-white">{{ __('Active Rentals') }}</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="bg-white/5">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Equipment') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Rented By') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Start Date') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('End Date') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-400 uppercase">{{ __('Total Price') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse($activeRentals as $rental)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-white">{{ $rental->equipment->name }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-400">{{ $rental->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-400">{{ $rental->start_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-400">{{ $rental->end_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-blue-400">{{ number_format($rental->total_price, 2) }} AF</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        {{ __('No active rentals at the moment.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($monthlyRevenue)->pluck('month')) !!},
                datasets: [{
                    label: 'Revenue (AF)',
                    data: {!! json_encode(collect($monthlyRevenue)->pluck('revenue')) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($equipmentStatus->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($equipmentStatus->pluck('count')) !!},
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'bottom' }
                }
            }
        });

        // Top Equipment Chart
        const topCtx = document.getElementById('topEquipmentChart').getContext('2d');
        new Chart(topCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topEquipment->pluck('name')) !!},
                datasets: [{
                    label: 'Number of Rentals',
                    data: {!! json_encode($topEquipment->pluck('rentals_count')) !!},
                    backgroundColor: 'rgba(147, 51, 234, 0.8)'
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</x-app-layout>
