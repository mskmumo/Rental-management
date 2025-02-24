<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Order Summary -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                            
                            <div class="space-y-6">
                                @foreach($cartItems as $item)
                                    <div class="flex items-center space-x-4 border-b pb-6 last:border-b-0 last:pb-0">
                                        <img src="{{ Storage::url($item->room->image_path) }}" 
                                            alt="{{ $item->room->name }}" 
                                            class="w-20 h-20 object-cover rounded-lg">
                                        
                                        <div class="flex-grow">
                                            <h4 class="text-base font-medium text-gray-900">{{ $item->room->name }}</h4>
                                            <div class="mt-1 text-sm text-gray-500">
                                                <p>Check-in: {{ $item->check_in_date->format('M d, Y') }}</p>
                                                <p>Check-out: {{ $item->check_out_date->format('M d, Y') }}</p>
                                                <p>Guests: {{ $item->guests }}</p>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-base font-medium text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p>${{ number_format($cartItems->sum('total_price'), 2) }}</p>
                                </div>
                                <div class="flex justify-between text-sm text-gray-500 mt-1">
                                    <p>Taxes</p>
                                    <p>Included</p>
                                </div>
                                <div class="flex justify-between text-lg font-bold text-gray-900 mt-4">
                                    <p>Total</p>
                                    <p>ksh {{ number_format($cartItems->sum('total_price'), 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Details</h3>

                            <form action="{{ route('client.payments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $cartItems->sum('total_price') }}">
                                <input type="hidden" name="payment_method" value="mpesa">

                                <div class="space-y-4">
                                    <div>
                                        <label for="phone_number" class="block text-sm font-medium text-gray-700">M-Pesa Phone Number</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">+254</span>
                                            </div>
                                            <input type="text" 
                                                name="phone_number" 
                                                id="phone_number" 
                                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md" 
                                                placeholder="7XXXXXXXX"
                                                pattern="[0-9]{9}"
                                                required>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">Enter your Safaricom number without the country code</p>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-md">
                                        <h4 class="text-sm font-medium text-gray-900 mb-2">Payment Instructions:</h4>
                                        <ol class="list-decimal list-inside text-sm text-gray-600 space-y-1">
                                            <li>Enter your M-Pesa registered phone number</li>
                                            <li>Click on "Pay Now"</li>
                                            <li>Wait for the M-Pesa prompt on your phone</li>
                                            <li>Enter your M-Pesa PIN to complete the payment</li>
                                        </ol>
                                    </div>

                                    <button type="submit" 
                                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Pay Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 