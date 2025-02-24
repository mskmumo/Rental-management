<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Room Details') }}
            </h2>
            <a href="{{ route('admin.rooms.edit', $room) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                {{ __('Edit Room') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Room Image -->
                        <div>
                            <img src="{{ Storage::url($room->image_path) }}" 
                                alt="{{ $room->name }}" 
                                class="w-full h-64 object-cover rounded-lg">
                        </div>

                        <!-- Room Details -->
                        <div>
                            <h3 class="text-2xl font-bold mb-4">{{ $room->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $room->description }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <span class="font-semibold">Price per Night:</span>
                                    <p class="text-indigo-600 text-xl">ksh {{ number_format($room->price_per_night, 2) }}</p>
                                </div>
                                <div>
                                    <span class="font-semibold">Capacity:</span>
                                    <p>{{ $room->capacity }} {{ Str::plural('person', $room->capacity) }}</p>
                                </div>
                            </div>

                            <!-- Amenities -->
                            <div>
                                <h4 class="font-semibold text-lg mb-3">Amenities</h4>
                                <div class="grid grid-cols-2 gap-3">
                                    @forelse($room->amenities as $amenity)
                                        <span class="inline-flex items-center bg-gray-100 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-{{ $amenity->icon }} text-gray-500 mr-2"></i>
                                            {{ $amenity->name }}
                                        </span>
                                    @empty
                                        <p class="text-gray-500">No amenities listed</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 