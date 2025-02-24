<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($bookings->count() > 0)
                        <div class="space-y-6">
                            @foreach($bookings as $booking)
                                <div class="border rounded-lg p-6 {{ $booking->status === 'cancelled' ? 'bg-gray-50' : '' }}">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $booking->room->name }}</h3>
                                            <div class="mt-2 space-y-1">
                                                <p class="text-sm text-gray-600">
                                                    Check-in: {{ $booking->check_in_date->format('Y-m-d') }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    Check-out: {{ $booking->check_out_date->format('Y-m-d') }}
                                                </p>
                                                <p class="text-sm font-medium">
                                                    Total: ksh {{ number_format($booking->total_price, 2) }}
                                                </p>
                                                <p class="text-sm">
                                                    Status: 
                                                    <span class="font-medium 
                                                        {{ $booking->status === 'confirmed' ? 'text-green-600' : '' }}
                                                        {{ $booking->status === 'cancelled' ? 'text-red-600' : '' }}
                                                        {{ $booking->status === 'pending' ? 'text-yellow-600' : '' }}">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="space-x-2">
                                            <a href="{{ route('my.bookings.show', $booking) }}" 
                                                class="text-blue-600 hover:text-blue-900">
                                                View Details
                                            </a>
                                            @if($booking->status === 'confirmed')
                                                <form action="{{ route('my.bookings.cancel', $booking) }}" 
                                                    method="POST" 
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-600">You have no bookings yet.</p>
                        <div class="text-center mt-4">
                            <a href="{{ route('rooms.browse') }}" class="text-blue-600 hover:text-blue-900">
                                Browse Rooms
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 