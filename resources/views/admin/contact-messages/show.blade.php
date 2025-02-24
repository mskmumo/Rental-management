<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('View Message') }}
            </h2>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left"></i> Back to Messages
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Message Details -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $message->subject }}</h3>
                                <p class="text-sm text-gray-500">From: {{ $message->name }} ({{ $message->email }})</p>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $message->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <p class="text-gray-700 whitespace-pre-line">{{ $message->message }}</p>
                        </div>

                        @if($message->status === 'replied')
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Reply sent by {{ $message->repliedBy->name }}</h4>
                                <div class="bg-indigo-50 rounded-lg p-4">
                                    <p class="text-gray-700">{{ $message->reply }}</p>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Replied on {{ $message->replied_at->format('M d, Y H:i') }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Reply Form -->
                    @if($message->status !== 'replied')
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Send Reply</h3>
                            <form action="{{ route('admin.contact-messages.reply', $message) }}" method="POST">
                                @csrf
                                <div>
                                    <x-input-label for="reply" :value="__('Reply Message')" />
                                    <textarea id="reply" name="reply" rows="4" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                        required>{{ old('reply') }}</textarea>
                                    <x-input-error :messages="$errors->get('reply')" class="mt-2" />
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <x-primary-button>
                                        {{ __('Send Reply') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 