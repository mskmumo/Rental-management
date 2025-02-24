<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    @push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}"></script>
    <script>
        function initMap() {
            const hotelLocation = { lat: -1.2921, lng: 36.8219 }; // Update with your hotel's coordinates
            const map = new google.maps.Map(document.getElementById('contactMap'), {
                center: hotelLocation,
                zoom: 15
            });

            const marker = new google.maps.Marker({
                position: hotelLocation,
                map: map,
                title: 'Pahali Pazuri'
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="p-2">
                        <h3 class="font-semibold">Pahali Pazuri</h3>
                        <p class="text-sm">Your Premier Rental Destination</p>
                    </div>
                `
            });

            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        }
    </script>
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Contact Form -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Send us a Message</h3>
                            
                            @if(session('success'))
                                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="subject" :value="__('Subject')" />
                                        <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" :value="old('subject')" required />
                                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="message" :value="__('Message')" />
                                        <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('message') }}</textarea>
                                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <x-primary-button>
                                            {{ __('Send Message') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Contact Information and Map -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Find Us</h3>
                            
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-map-marker-alt text-indigo-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">Address</h4>
                                            <p class="text-sm text-gray-500">123 Hotel Street, Nairobi, Kenya</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-phone text-indigo-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">Phone</h4>
                                            <p class="text-sm text-gray-500">+254 123 456 789</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-envelope text-indigo-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">Email</h4>
                                            <p class="text-sm text-gray-500">info@pahalipazuri.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Map -->
                            <div class="h-96">
                                <div id="contactMap" class="w-full h-full rounded-lg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
    @endpush
</x-app-layout> 