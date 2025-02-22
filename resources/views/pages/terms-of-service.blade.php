<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms of Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Terms of Service</h1>
                    
                    <div class="prose max-w-none">
                        <h2>1. Acceptance of Terms</h2>
                        <p>By accessing and using this website, you accept and agree to be bound by the terms...</p>

                        <h2>2. User Responsibilities</h2>
                        <p>Users must provide accurate information when...</p>

                        <!-- Add more sections as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 