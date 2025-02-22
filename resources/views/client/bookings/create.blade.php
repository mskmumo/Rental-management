<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Room Details</h3>
                        <div class="mt-2 flex items-center space-x-4">
                            <img src="{{ Storage::url($room->image_path) }}" 
                                alt="{{ $room->name }}" 
                                class="w-24 h-24 object-cover rounded-lg">
                            <div>
                                <h4 class="text-base font-medium">{{ $room->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $room->description }}</p>
                                <p class="text-indigo-600 font-medium">${{ number_format($room->price_per_night, 2) }} / night</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('client.bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full" 
                                    :value="old('phone_number')" required />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" 
                                    :value="old('address')" required />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="check_in_date" :value="__('Check-in Date')" />
                                <x-text-input id="check_in_date" name="check_in_date" type="date" 
                                    class="mt-1 block w-full" :value="old('check_in_date')" 
                                    min="{{ date('Y-m-d') }}" required />
                                <x-input-error :messages="$errors->get('check_in_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="check_out_date" :value="__('Check-out Date')" />
                                <x-text-input id="check_out_date" name="check_out_date" type="date" 
                                    class="mt-1 block w-full" :value="old('check_out_date')" 
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" required />
                                <x-input-error :messages="$errors->get('check_out_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="guests" :value="__('Number of Guests')" />
                                <select id="guests" name="guests" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                    required>
                                    @for($i = 1; $i <= $room->capacity; $i++)
                                        <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ Str::plural('Guest', $i) }}
                                        </option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('guests')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div>
                            <x-input-label for="special_requests" :value="__('Special Requests (Optional)')" />
                            <textarea id="special_requests" name="special_requests" rows="3" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('special_requests') }}</textarea>
                            <x-input-error :messages="$errors->get('special_requests')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('rooms.browse') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Proceed to Payment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 