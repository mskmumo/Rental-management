<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-gray-900 to-indigo-900 rounded-xl shadow-xl mb-6 overflow-hidden">
                <div class="px-8 py-12">
                    <h1 class="text-3xl font-bold text-white mb-2">Admin Dashboard</h1>
                    <p class="text-gray-300">Manage bookings, rooms, and user accounts from your central dashboard.</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Total Bookings -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Total Bookings</h2>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalBookings ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-green-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Total Revenue</h2>
                                <p class="text-2xl font-semibold text-gray-900">Ksh{{ number_format($totalRevenue ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Users -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Active Users</h2>
                                <p class="text-2xl font-semibold text-gray-900">{{ $activeUsers ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room Occupancy -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Room Occupancy</h2>
                                <p class="text-2xl font-semibold text-gray-900">{{ $occupancyRate ?? 0 }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Pending Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900">Pending Actions</h2>
                                <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All</a>
                            </div>
                            
                            <div class="space-y-4">
                                @forelse($pendingBookings ?? [] as $booking)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <img src="{{ $booking->user->avatar ?? asset('images/avatar-placeholder.jpg') }}" 
                                            alt="User" 
                                            class="w-10 h-10 rounded-full object-cover">
                                        <div class="ml-4">
                                            <h3 class="font-medium text-gray-900">{{ $booking->user->name }}</h3>
                                            <p class="text-sm text-gray-600">
                                                Room {{ $booking->room->number }} • 
                                                {{ \Carbon\Carbon::parse($booking->check_in)->format('M d') }} - 
                                                {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-gray-600 py-4">No pending bookings</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Chart -->
                    <div class="mt-6 bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900">Booking Analytics</h2>
                                <div class="flex items-center gap-4">
                                    <select class="text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                        <option>Last 7 Days</option>
                                        <option>Last 30 Days</option>
                                        <option>Last 3 Months</option>
                                    </select>
                                    <a href="{{ route('admin.reports.bookings') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                        Detailed Report →
                                    </a>
                                </div>
                            </div>
                            <div class="h-64">
                                <!-- Add your chart component here -->
                                <div class="flex items-center justify-center h-full bg-gray-50 rounded-lg">
                                    <p class="text-gray-600">Booking trends chart will be displayed here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions and Recent Activity -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Actions</h2>
                        <div class="space-y-4">
                                <a href="{{ route('admin.rooms.create') }}" 
                                    class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                    <div class="bg-indigo-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Add New Room</h3>
                                        <p class="text-sm text-gray-600">Create a new room listing</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.users.index') }}" 
                                    class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                    <div class="bg-indigo-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Manage Users</h3>
                                        <p class="text-sm text-gray-600">View and manage user accounts</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.reports') }}" 
                                    class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                    <div class="bg-indigo-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">View Reports</h3>
                                        <p class="text-sm text-gray-600">Access analytics and reports</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                                        </div>

                    <!-- Recent Activity -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6">Recent Activity</h2>
                            <div class="space-y-4">
                                @forelse($recentActivities ?? [] as $activity)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-500">
                                            <span class="text-sm font-medium leading-none text-white">
                                                {{ substr($activity->user->name ?? 'U', 0, 1) }}
                                            </span>
                                        </span>
                                        </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm text-gray-900">
                                            {{ $activity->description }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $activity->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-gray-600 py-4">No recent activity</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json(array_map(function($month) {
                    return Carbon\Carbon::create()->month($month)->format('F');
                }, array_keys($monthlyRevenue))),
                datasets: [{
                    label: 'Revenue',
                    data: @json(array_values($monthlyRevenue)),
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
