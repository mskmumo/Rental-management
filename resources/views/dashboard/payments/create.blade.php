<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">Payment Details</h2>

                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">Booking Summary</h3>
                        <div class="mt-4 space-y-2">
                            <p><span class="font-medium">Room:</span> {{ $booking->room->name }}</p>
                            <p><span class="font-medium">Check-in:</span> {{ $booking->check_in->format('M d, Y') }}</p>
                            <p><span class="font-medium">Check-out:</span> {{ $booking->check_out->format('M d, Y') }}</p>
                            <p><span class="font-medium">Total Amount:</span> ${{ $booking->total_amount }}</p>
                        </div>
                    </div>

                    <form action="{{ route('payments.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <!-- Payment Method -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" value="credit_card" checked
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label class="ml-3 block text-sm font-medium text-gray-700">
                                        Credit Card
                                    </label>
                                </div>
                                <!-- Add more payment methods as needed -->
                            </div>
                        </div>

                        <!-- Credit Card Details -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Card Number</label>
                                <input type="text" name="card_number" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="1234 5678 9012 3456">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Expiration Date</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <select name="expiry_month" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @foreach(range(1, 12) as $month)
                                                <option value="{{ sprintf('%02d', $month) }}">
                                                    {{ sprintf('%02d', $month) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="expiry_year" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">CVV</label>
                                    <input type="text" name="cvv" maxlength="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="123">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cardholder Name</label>
                                <input type="text" name="cardholder_name" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="John Doe">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Complete Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 