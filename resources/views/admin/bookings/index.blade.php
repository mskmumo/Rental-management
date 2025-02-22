<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
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
                                <th class="px-6 py-3 border-b">Booking ID</th>
                                <th class="px-6 py-3 border-b">Guest</th>
                                <th class="px-6 py-3 border-b">Room</th>
                                <th class="px-6 py-3 border-b">Check In</th>
                                <th class="px-6 py-3 border-b">Check Out</th>
                                <th class="px-6 py-3 border-b">Status</th>
                                <th class="px-6 py-3 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 border-b">#{{ $booking->id }}</td>
                                    <td class="px-6 py-4 border-b">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4 border-b">{{ $booking->room->name }}</td>
                                    <td class="px-6 py-4 border-b">{{ $booking->check_in_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 border-b">{{ $booking->check_out_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 border-b">
                                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded-md shadow-sm">
                                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline">
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
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 