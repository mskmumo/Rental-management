<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Booking Details') }}
            </h2>
            <div class="flex space-x-4">
                @if($booking->status === 'pending')
                    <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <x-primary-button>
                            {{ __('Approve') }}
                        </x-primary-button>
                    </form>

                    <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                            {{ __('Reject') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Booking Status -->
                    <div class="mb-6">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                            @if($booking->status === 'confirmed') bg-green-100 text-green-800
                            @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <!-- Room Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Room Information</h3>
                            <div class="flex items-start space-x-4">
                                <img src="{{ Storage::url($booking->room->image_path) }}" 
                                    alt="{{ $booking->room->name }}" 
                                    class="w-32 h-32 object-cover rounded-lg">
                                <div>
                                    <h4 class="font-medium">{{ $booking->room->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $booking->room->description }}</p>
                                    <p class="text-indigo-600 font-medium mt-2">${{ number_format($booking->room->price_per_night, 2) }} / night</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Guest Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Name:</span> {{ $booking->user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $booking->user->email }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $booking->phone_number }}</p>
                                <p><span class="font-medium">Address:</span> {{ $booking->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-600">Check-in Date</p>
                                <p class="font-medium">{{ $booking->check_in_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Check-out Date</p>
                                <p class="font-medium">{{ $booking->check_out_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Number of Guests</p>
                                <p class="font-medium">{{ $booking->guests }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Price</p>
                                <p class="font-medium text-lg text-green-600">${{ number_format($booking->total_price, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Booking Date</p>
                                <p class="font-medium">{{ $booking->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($booking->special_requests)
                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Special Requests</h3>
                            <p class="text-gray-600">{{ $booking->special_requests }}</p>
                        </div>
                    @endif

                    <!-- Approval/Rejection Details -->
                    @if($booking->approved_at)
                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Approval Details</h3>
                            <p class="text-sm text-gray-600">
                                Approved by {{ $booking->approver->name }} on {{ $booking->approved_at->format('M d, Y H:i') }}
                            </p>
                        </div>
                    @endif

                    @if($booking->rejected_at)
                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Rejection Details</h3>
                            <p class="text-sm text-gray-600">
                                Rejected by {{ $booking->rejecter->name }} on {{ $booking->rejected_at->format('M d, Y H:i') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 