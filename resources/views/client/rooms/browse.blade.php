<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('rooms.browse') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Apartment Type Filter -->
                        <div>
                            <x-input-label for="apartment_type" :value="__('Apartment Type')" />
                            <select id="apartment_type" name="apartment_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Types</option>
                                @foreach($apartmentTypes as $type)
                                    <option value="{{ $type->id }}" {{ request('apartment_type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bed Type Filter -->
                        <div>
                            <x-input-label for="bed_type" :value="__('Bed Type')" />
                            <select id="bed_type" name="bed_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Bed Types</option>
                                @foreach($bedTypes as $type)
                                    <option value="{{ $type->id }}" {{ request('bed_type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Capacity Filter -->
                        <div>
                            <x-input-label for="capacity" :value="__('Min. Capacity')" />
                            <x-text-input id="capacity" type="number" name="capacity" class="mt-1 block w-full" 
                                :value="request('capacity')" min="1" />
                        </div>

                        <!-- Price Range Filter -->
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <x-input-label for="price_min" :value="__('Min Price')" />
                                <x-text-input id="price_min" type="number" name="price_min" class="mt-1 block w-full" 
                                    :value="request('price_min')" min="0" step="0.01" />
                            </div>
                            <div>
                                <x-input-label for="price_max" :value="__('Max Price')" />
                                <x-text-input id="price_max" type="number" name="price_max" class="mt-1 block w-full" 
                                    :value="request('price_max')" min="0" step="0.01" />
                            </div>
                        </div>

                        <div class="md:col-span-2 lg:col-span-4 flex justify-end">
                            <x-primary-button>
                                {{ __('Apply Filters') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Rooms Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($rooms as $room)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- Room Image -->
                        <img src="{{ Storage::url($room->image_path) }}" 
                            alt="{{ $room->name }}" 
                            class="w-full h-48 object-cover">
                        
                        <div class="p-6">
                            <!-- Room Header -->
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $room->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $room->apartmentType->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-indigo-600">Ksh {{ number_format($room->price_per_night, 2) }}</p>
                                    <p class="text-sm text-gray-600">per night</p>
                                </div>
                            </div>

                            <!-- Room Details -->
                            <div class="space-y-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-bed mr-2"></i>
                                    <span>{{ $room->bedType->name }}</span>
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-user mr-2"></i>
                                    <span>Up to {{ $room->capacity }} guests</span>
                                </div>

                                <!-- Amenities -->
                                <div class="border-t pt-4">
                                    <p class="text-sm font-medium text-gray-900 mb-2">Amenities:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($room->amenities as $amenity)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                <i class="fas fa-{{ $amenity->icon }} mr-1"></i>
                                                {{ $amenity->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <p class="text-lg font-bold text-indigo-600">Ksh {{ number_format($room->price_per_night, 2) }} / night</p>
                                    <p class="text-sm text-gray-500">Capacity: {{ $room->capacity }} guests</p>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-6">
                                    @auth
                                        <a href="{{ route('client.bookings.create', ['room_id' => $room->id]) }}" 
                                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                            Book Now
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                            Login to Book
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600">No rooms found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 