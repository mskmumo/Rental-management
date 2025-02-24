<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
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
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Contact Form -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Send us a Message</h3>
                            <form action="{{ route('contact.submitContact') }}" method="POST" class="space-y-4">
                                @csrf
                                
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                        :value="old('name')" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                                        :value="old('email')" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="subject" :value="__('Subject')" />
                                    <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" 
                                        :value="old('subject')" required />
                                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="message" :value="__('Message')" />
                                    <textarea id="message" name="message" rows="4" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                        required>{{ old('message') }}</textarea>
                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end">
                                    <x-primary-button>
                                        {{ __('Send Message') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Get in Touch</h3>
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-indigo-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-gray-900">Address</h4>
                                        <p class="text-sm text-gray-500">{{ $siteSettings['contact_address'] ?? 'Our Location' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-phone text-indigo-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-gray-900">Phone</h4>
                                        <p class="text-sm text-gray-500">{{ $siteSettings['contact_phone'] ?? 'Phone Number' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-envelope text-indigo-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-gray-900">Email</h4>
                                        <p class="text-sm text-gray-500">{{ $siteSettings['contact_email'] ?? 'Email Address' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Map -->
                            <div class="mt-8 h-96">
                                <div id="contactMap" class="w-full h-full rounded-lg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}"></script>
    <script>
        function initMap() {
            const hotelLocation = { 
                lat: {{ $siteSettings['hotel_latitude'] ?? -1.2921 }}, 
                lng: {{ $siteSettings['hotel_longitude'] ?? 36.8219 }}
            };
            
            const map = new google.maps.Map(document.getElementById('contactMap'), {
                center: hotelLocation,
                zoom: 15,
                styles: [
                    {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{ visibility: "off" }]
                    }
                ]
            });

            const marker = new google.maps.Marker({
                position: hotelLocation,
                map: map,
                title: '{{ config('app.name') }}',
                animation: google.maps.Animation.DROP
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="p-2">
                        <h3 class="font-bold">{{ config('app.name') }}</h3>
                        <p class="text-sm">{{ $siteSettings['contact_address'] ?? 'Our Location' }}</p>
                    </div>
                `
            });

            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        }

        document.addEventListener('DOMContentLoaded', initMap);
    </script>
    @endpush
</x-app-layout> 