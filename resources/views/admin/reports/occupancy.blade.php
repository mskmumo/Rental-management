<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Occupancy Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Overall Occupancy Stats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Overall Occupancy Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm text-gray-600">Current Occupancy Rate</p>
                            <p class="text-3xl font-bold text-green-600">{{ number_format($currentOccupancyRate, 1) }}%</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Average Monthly Occupancy</p>
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($averageMonthlyOccupancy, 1) }}%</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Available Rooms</p>
                            <p class="text-3xl font-bold text-indigo-600">{{ $totalRooms }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Occupancy Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Occupancy Trends</h3>
                    <div class="h-64">
                        <canvas id="occupancyChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Monthly Occupancy Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Occupancy Details</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Month
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Occupancy Rate
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Occupied Room Nights
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Available Room Nights
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($monthlyOccupancy as $data)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $data['month'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($data['occupancy_rate'], 1) }}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $data['occupied_nights'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $data['available_nights'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('occupancyChart').getContext('2d');
            const monthlyData = @json($monthlyOccupancy);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthlyData.map(data => data.month),
                    datasets: [{
                        label: 'Monthly Occupancy Rate',
                        data: monthlyData.map(data => data.occupancy_rate),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout> 