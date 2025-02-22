<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Rooms') }}
            </h2>
            <a href="{{ route('admin.rooms.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Room
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b">Image</th>
                                <th class="px-6 py-3 border-b">Name</th>
                                <th class="px-6 py-3 border-b">Price</th>
                                <th class="px-6 py-3 border-b">Status</th>
                                <th class="px-6 py-3 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td class="px-6 py-4 border-b">
                                        <img src="{{ Storage::url($room->image_path) }}" alt="{{ $room->name }}" class="w-20 h-20 object-cover">
                                    </td>
                                    <td class="px-6 py-4 border-b">{{ $room->name }}</td>
                                    <td class="px-6 py-4 border-b">${{ $room->price_per_night }}</td>
                                    <td class="px-6 py-4 border-b">{{ $room->status }}</td>
                                    <td class="px-6 py-4 border-b">
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 