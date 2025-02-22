<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="flex items-start p-4 {{ $notification->read_at ? 'bg-gray-50' : 'bg-blue-50' }} rounded-lg">
                                    <div class="flex-shrink-0">
                                        @if(!$notification->read_at)
                                            <span class="inline-block w-2 h-2 mt-2 bg-blue-600 rounded-full"></span>
                                        @else
                                            <span class="inline-block w-2 h-2 mt-2 bg-gray-400 rounded-full"></span>
                                        @endif
                                    </div>
                                    <div class="ml-3 flex-grow">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $notification->data['message'] ?? 'Notification' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        @if(isset($notification->data['description']))
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ $notification->data['description'] }}
                                            </p>
                                        @endif
                                        @if(!$notification->read_at)
                                            <div class="mt-2">
                                                <form action="{{ route('client.notifications.mark-as-read', $notification->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-900">
                                                        Mark as read
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-bell text-gray-400 text-5xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Notifications</h3>
                            <p class="text-gray-500">You don't have any notifications at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 