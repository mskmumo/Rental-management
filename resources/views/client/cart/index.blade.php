<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="space-y-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center justify-between border-b pb-6 last:border-b-0 last:pb-0">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ Storage::url($item->room->image_path) }}" 
                                            alt="{{ $item->room->name }}" 
                                            class="w-24 h-24 object-cover rounded-lg">
                                        
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $item->room->name }}</h3>
                                            <div class="mt-1 text-sm text-gray-500">
                                                <p>Check-in: {{ $item->check_in_date->format('M d, Y') }}</p>
                                                <p>Check-out: {{ $item->check_out_date->format('M d, Y') }}</p>
                                                <p>Guests: {{ $item->guests }}</p>
                                            </div>
                                            <div class="mt-2 flex items-center space-x-2">
                                                @foreach($item->room->amenities as $amenity)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                        <i class="fas fa-{{ $amenity->icon }} mr-1"></i>
                                                        {{ $amenity->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-lg font-medium text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                                        <form action="{{ route('client.cart.destroy', $item) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-900">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8 border-t pt-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-medium text-gray-900">Total</p>
                                    <p class="text-sm text-gray-500">Including all taxes and fees</p>
                                </div>
                                <p class="text-2xl font-bold text-gray-900">
                                    ${{ number_format($cartItems->sum('total_price'), 2) }}
                                </p>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('client.cart.checkout') }}" 
                                    class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <i class="fas fa-shopping-cart text-gray-400 text-5xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Your Cart is Empty</h3>
                        <p class="text-gray-500 mb-4">Add some rooms to your cart to get started.</p>
                        <a href="{{ route('rooms.browse') }}" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Browse Rooms
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 