<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-xl shadow-xl mb-6 overflow-hidden">
                <div class="px-8 py-12">
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome Back, {{ auth()->user()->name }}!</h1>
                    <p class="text-indigo-100">Manage your bookings and account settings from your personal dashboard.</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Active Bookings -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Active Bookings</h2>
                                <p class="text-2xl font-semibold text-gray-900">{{ $activeBookings ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Spent -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-green-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Total Spent</h2>
                                <p class="text-2xl font-semibold text-gray-900">${{ $totalSpent ?? '0.00' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loyalty Points -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 rounded-lg p-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-600">Loyalty Points</h2>
                                <p class="text-2xl font-semibold text-gray-900">{{ $loyaltyPoints ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Bookings -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900">Recent Bookings</h2>
                                <a href="{{ route('client.bookings.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All</a>
                            </div>
                            
                            <div class="space-y-4">
                                @forelse($recentBookings ?? [] as $booking)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <img src="{{ $booking->room->image ?? asset('images/room-placeholder.jpg') }}" 
                                            alt="Room" 
                                            class="w-16 h-16 rounded-lg object-cover">
                                        <div class="ml-4">
                                            <h3 class="font-medium text-gray-900">{{ $booking->room->name }}</h3>
                                            <p class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }} - 
                                                {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                               ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <p class="text-gray-600">No recent bookings found</p>
                                    <a href="{{ route('rooms.browse') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Browse Rooms</a>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Actions</h2>
                            <div class="space-y-4">
                        <a href="{{ route('rooms.browse') }}" 
                                    class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                    <div class="bg-indigo-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Browse Rooms</h3>
                                        <p class="text-sm text-gray-600">Find and book your next stay</p>
                                    </div>
                                </a>

                                <a href="{{ route('profile.edit') }}" 
                                    class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                    <div class="bg-indigo-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Update Profile</h3>
                                        <p class="text-sm text-gray-600">Manage your account settings</p>
                                    </div>
                                </a>

                                <a href="{{ route('client.payments.index') }}" 
                                    class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                    <div class="bg-indigo-100 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Payment History</h3>
                                        <p class="text-sm text-gray-600">View your transactions</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="mt-6 bg-white overflow-hidden shadow-sm rounded-xl">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900">Recent Notifications</h2>
                                <a href="{{ route('client.notifications') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">View All</a>
                            </div>
                            <div class="space-y-4">
                                @forelse($notifications ?? [] as $notification)
                                <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0">
                                        <span class="inline-block w-2 h-2 mt-2 rounded-full {{ $notification->read_at ? 'bg-gray-400' : 'bg-blue-600' }}"></span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-900">{{ $notification->data['message'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-gray-600 py-4">No new notifications</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 