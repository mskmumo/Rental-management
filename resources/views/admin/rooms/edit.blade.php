<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Room Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $room->name)" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('description', $room->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="price_per_night" :value="__('Price per Night')" />
                                <x-text-input id="price_per_night" name="price_per_night" type="number" step="0.01" class="mt-1 block w-full" :value="old('price_per_night', $room->price_per_night)" required />
                                <x-input-error :messages="$errors->get('price_per_night')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="capacity" :value="__('Capacity')" />
                                <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" :value="old('capacity', $room->capacity)" required />
                                <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="available" {{ $room->status === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="maintenance" {{ $room->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Room Image')" />
                                <input id="image" name="image" type="file" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                @if($room->image_path)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($room->image_path) }}" alt="{{ $room->name }}" class="w-32 h-32 object-cover">
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Update Room') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 