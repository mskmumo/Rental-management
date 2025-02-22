<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Room Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="price_per_night" :value="__('Price per Night')" />
                                <x-text-input id="price_per_night" name="price_per_night" type="number" step="0.01" class="mt-1 block w-full" :value="old('price_per_night')" required />
                                <x-input-error :messages="$errors->get('price_per_night')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="capacity" :value="__('Capacity')" />
                                <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" :value="old('capacity')" required />
                                <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                            </div>

                            <!-- Bed Type Selection -->
                            <div>
                                <x-input-label for="bed_type_id" :value="__('Bed Type')" />
                                <select id="bed_type_id" name="bed_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select a bed type</option>
                                    @foreach($bedTypes as $bedType)
                                        <option value="{{ $bedType->id }}" {{ old('bed_type_id') == $bedType->id ? 'selected' : '' }}>
                                            {{ $bedType->name }} - {{ $bedType->description }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('bed_type_id')" class="mt-2" />
                            </div>

                            <!-- Amenities Section -->
                            <div>
                                <x-input-label :value="__('Amenities')" />
                                <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach($amenities as $amenity)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" 
                                                name="amenities[]" 
                                                value="{{ $amenity->id }}"
                                                {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <span class="ml-2">
                                                <i class="fas fa-{{ $amenity->icon }} text-gray-500"></i>
                                                <span class="ml-1">{{ $amenity->name }}</span>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('amenities')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Room Image')" />
                                <input id="image" name="image" type="file" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" 
                                        name="is_featured" 
                                        value="1"
                                        {{ old('is_featured') ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2">Feature this room</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Create Room') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 