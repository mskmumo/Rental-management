<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Report Types Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Bookings Report -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-check text-2xl text-indigo-600 mr-3"></i>
                                <h3 class="text-lg font-medium text-gray-900">Bookings Report</h3>
                            </div>
                            <a href="{{ route('admin.reports.bookings') }}" class="text-sm text-indigo-600 hover:text-indigo-900">View Report →</a>
                        </div>
                        <p class="text-sm text-gray-600">
                            Analyze booking trends, occupancy rates, and booking status distribution.
                        </p>
                    </div>
                </div>

                <!-- Revenue Report -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-chart-line text-2xl text-green-600 mr-3"></i>
                                <h3 class="text-lg font-medium text-gray-900">Revenue Report</h3>
                            </div>
                            <a href="{{ route('admin.reports.revenue') }}" class="text-sm text-indigo-600 hover:text-indigo-900">View Report →</a>
                        </div>
                        <p class="text-sm text-gray-600">
                            Track revenue performance, payment statistics, and financial trends.
                        </p>
                    </div>
                </div>

                <!-- Occupancy Report -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-bed text-2xl text-blue-600 mr-3"></i>
                                <h3 class="text-lg font-medium text-gray-900">Occupancy Report</h3>
                            </div>
                            <a href="{{ route('admin.reports.occupancy') }}" class="text-sm text-indigo-600 hover:text-indigo-900">View Report →</a>
                        </div>
                        <p class="text-sm text-gray-600">
                            Monitor room occupancy rates, availability, and capacity utilization.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Report Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Report Filters</h3>
                    <form action="{{ route('admin.reports.bookings') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Booking Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Generate Report') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="p-4 bg-indigo-50 rounded-lg">
                            <p class="text-sm text-indigo-600 font-medium">Total Bookings</p>
                            <p class="text-2xl font-bold text-indigo-900">{{ $totalBookings ?? 0 }}</p>
                        </div>

                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-sm text-green-600 font-medium">Total Revenue</p>
                            <p class="text-2xl font-bold text-green-900">Ksh {{ number_format($totalRevenue ?? 0, 2) }}</p>
                        </div>

                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-600 font-medium">Average Occupancy Rate</p>
                            <p class="text-2xl font-bold text-blue-900">{{ number_format($averageOccupancy ?? 0, 1) }}%</p>
                        </div>

                        <div class="p-4 bg-purple-50 rounded-lg">
                            <p class="text-sm text-purple-600 font-medium">Active Users</p>
                            <p class="text-2xl font-bold text-purple-900">{{ $activeUsers ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 