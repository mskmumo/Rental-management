<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-8">Browse Rooms</h1>

            <!-- Filter Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <form action="{{ route('rooms.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apartment Type</label>
                        <select name="apartment_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Any Type</option>
                            @foreach($apartmentTypes as $type)
                                <option value="{{ $type->id }}" {{ request('apartment_type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bed Type</label>
                        <select name="bed_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Any Type</option>
                            @foreach($bedTypes as $type)
                                <option value="{{ $type->id }}" {{ request('bed_type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guests</label>
                        <select name="guests" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Any Number</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ request('guests') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ Str::plural('Guest', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Filter Results
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ $room->featured_image }}" alt="{{ $room->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-2">{{ $room->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($room->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-500 font-bold">${{ number_format($room->price_per_night) }}/night</span>
                                <a href="{{ route('rooms.show', $room) }}" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 