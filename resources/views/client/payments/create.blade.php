<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <!-- Booking Summary -->
                    <div class="mb-8 bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Summary</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Room</p>
                                <p class="font-medium">{{ $booking->room->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Check-in Date</p>
                                <p class="font-medium">{{ $booking->check_in_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Check-out Date</p>
                                <p class="font-medium">{{ $booking->check_out_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Amount</p>
                                <p class="font-medium text-lg text-green-600">KES {{ number_format($booking->total_price, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- M-Pesa Payment Form -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pay with M-Pesa</h3>
                        <p class="text-sm text-gray-600 mb-6">
                            Enter your M-Pesa phone number below. You will receive a prompt on your phone to complete the payment.
                        </p>

                        @if (session('error'))
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('client.payments.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <input type="hidden" name="amount" value="{{ $booking->total_price }}">
                            <input type="hidden" name="payment_method" value="mpesa">

                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">M-Pesa Phone Number</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">+254</span>
                                    </div>
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="7XXXXXXXX"
                                        pattern="[0-9]{9}"
                                        title="Please enter a valid Safaricom number (9 digits)"
                                        required>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Enter your Safaricom number without the country code (e.g., 712345678)</p>
                                @error('phone_number')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('client.bookings.show', $booking) }}" 
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    Back to Booking
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Pay with M-Pesa
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h4 class="text-sm font-medium text-gray-900">How to Pay:</h4>
                        <ol class="mt-4 list-decimal list-inside space-y-2 text-sm text-gray-600">
                            <li>Enter your M-Pesa registered phone number above</li>
                            <li>Click on "Pay with M-Pesa"</li>
                            <li>Wait for the M-Pesa prompt on your phone</li>
                            <li>Enter your M-Pesa PIN to complete the payment</li>
                            <li>You will receive a confirmation message once the payment is complete</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 