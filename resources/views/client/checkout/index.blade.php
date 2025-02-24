<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Booking Summary -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Booking Summary</h3>
                            @foreach($rooms as $room)
                                <div class="border-b pb-4 mb-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ Storage::url($room->image_path) }}" 
                                            alt="{{ $room->name }}" 
                                            class="w-24 h-16 object-cover rounded">
                                        <div>
                                            <h4 class="font-semibold">{{ $room->name }}</h4>
                                            <p class="text-sm text-gray-600">
                                                Check-in: {{ $cartItems[$room->id]['check_in_date'] }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                Check-out: {{ $cartItems[$room->id]['check_out_date'] }}
                                            </p>
                                            <p class="text-sm font-semibold mt-1">
                                                Ksh {{ $room->price_per_night }}/night
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-xl font-bold mt-4">
                                Total: Ksh {{ number_format($total, 2) }}
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Payment Details</h3>
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <select name="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="credit_card">Credit Card</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                    </div>

                                    <div id="credit-card-fields">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Card Number</label>
                                            <input type="text" name="card_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 mt-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                                                <input type="text" name="expiry_date" placeholder="MM/YY" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">CVV</label>
                                                <input type="text" name="cvv" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Complete Payment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
            const creditCardFields = document.getElementById('credit-card-fields');
            creditCardFields.style.display = this.value === 'credit_card' ? 'block' : 'none';
        });
    </script>
    @endpush
</x-app-layout> 