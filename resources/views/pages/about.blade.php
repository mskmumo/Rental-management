<x-app-layout>
    <!-- Hero Section -->
    <div class="relative h-[400px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
            alt="About Us Hero" 
            class="w-full h-full object-cover"
            style="filter: brightness(0.6);">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">About Pahali Pazuri</h1>
                <p class="text-xl md:text-2xl">Your Premier Rental Destination</p>
            </div>
        </div>
    </div>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Our Story Section -->
            <div class="mb-20">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                        <div class="prose max-w-none">
                            <p class="text-lg text-gray-600 mb-6">{{ $siteSettings['about_content'] ?? 'At Pahali Pazuri, we believe that finding the perfect place to stay should be an effortless and enjoyable experience. Since our establishment, we have been dedicated to providing exceptional rental accommodations that combine comfort, luxury, and convenience.' }}</p>
                            <p class="text-lg text-gray-600">Our journey began with a simple vision: to create a rental platform that puts our guests' needs first, offering carefully curated properties that meet the highest standards of quality and comfort.</p>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                            alt="Our Story" 
                            class="rounded-lg shadow-xl">
                    </div>
                </div>
            </div>

            <!-- Vision & Mission Section -->
            <div class="mb-20">
                <div class="grid md:grid-cols-2 gap-12">
                    <div class="bg-indigo-50 p-8 rounded-lg">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-eye text-2xl text-indigo-600 mr-3"></i>
                            <h3 class="text-2xl font-bold text-gray-900">Our Vision</h3>
                        </div>
                        <p class="text-gray-600">To be the leading rental platform that transforms the way people experience temporary accommodations, setting new standards for quality, comfort, and customer service in the industry.</p>
                    </div>
                    <div class="bg-blue-50 p-8 rounded-lg">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-bullseye text-2xl text-blue-600 mr-3"></i>
                            <h3 class="text-2xl font-bold text-gray-900">Our Mission</h3>
                        </div>
                        <p class="text-gray-600">To provide exceptional rental experiences through carefully selected properties, transparent processes, and dedicated customer service, ensuring every guest finds their perfect temporary home.</p>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Section -->
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Why Choose Pahali Pazuri</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                        <div class="inline-block p-4 bg-indigo-100 rounded-full mb-4">
                            <i class="fas fa-home text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Premium Properties</h3>
                        <p class="text-gray-600">Carefully selected accommodations that meet our high standards for quality and comfort.</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                        <div class="inline-block p-4 bg-indigo-100 rounded-full mb-4">
                            <i class="fas fa-shield-alt text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Secure Booking</h3>
                        <p class="text-gray-600">Safe and transparent booking process with instant confirmation and secure payments.</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                        <div class="inline-block p-4 bg-indigo-100 rounded-full mb-4">
                            <i class="fas fa-headset text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                        <p class="text-gray-600">Dedicated customer service team available around the clock to assist you.</p>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="mb-20">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="grid md:grid-cols-3 gap-8 text-center">
                        <div>
                            <div class="text-4xl font-bold text-indigo-600 mb-2">1000+</div>
                            <div class="text-gray-600">Happy Guests</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-indigo-600 mb-2">100+</div>
                            <div class="text-gray-600">Premium Rooms</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-indigo-600 mb-2">24/7</div>
                            <div class="text-gray-600">Customer Support</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Values Section -->
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Our Values</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <i class="fas fa-heart text-2xl text-red-500 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Customer First</h3>
                        <p class="text-gray-600">Your satisfaction is our top priority in everything we do.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <i class="fas fa-star text-2xl text-yellow-500 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Excellence</h3>
                        <p class="text-gray-600">We maintain high standards in all our services and properties.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <i class="fas fa-handshake text-2xl text-green-500 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Integrity</h3>
                        <p class="text-gray-600">We operate with honesty and transparency in all interactions.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <i class="fas fa-sync text-2xl text-blue-500 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Innovation</h3>
                        <p class="text-gray-600">Continuously improving our services to serve you better.</p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Ready to Experience Pahali Pazuri?</h2>
                <p class="text-lg text-gray-600 mb-8">Browse our selection of premium rental properties and find your perfect stay today.</p>
                <a href="{{ route('rooms.browse') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Browse Rooms
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</x-app-layout> 