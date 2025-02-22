<x-app-layout>
    <!-- SEO Meta Tags -->
    @section('meta')
        <title>{{ $siteSettings['meta_title'] ?? config('app.name') }}</title>
        <meta name="description" content="{{ $siteSettings['meta_description'] ?? '' }}">
        <meta name="keywords" content="{{ $siteSettings['meta_keywords'] ?? '' }}">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <!-- Hero Section with Full-Screen Design -->
    <div class="relative min-h-screen">
        <!-- Hero background image with parallax effect -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-bg.jpg') }}" 
                alt="Hero Background" 
                class="w-full h-full object-cover"
                style="filter: brightness(0.4);">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen flex items-center">
            <div class="lg:w-2/3">
                <div class="animate-fade-in-up">
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                        {{ $siteSettings['hero_title'] ?? 'Find Your Perfect Stay' }}
                </h1>
                    <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed">
                        {{ $siteSettings['hero_subtitle'] ?? 'Book unique accommodations and experience comfort like never before.' }}
                    </p>
                    <a href="{{ $siteSettings['hero_cta_link'] ?? route('rooms.browse') }}" 
                        class="inline-flex items-center px-8 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ $siteSettings['hero_cta_text'] ?? 'Browse Rooms' }}
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Rooms Gallery Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $siteSettings['gallery_title'] ?? 'Explore Our Rooms' }}
                </h2>
                <p class="text-xl text-gray-600">
                    {{ $siteSettings['gallery_subtitle'] ?? 'Discover comfort and luxury in our carefully curated selection of rooms' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredRooms as $room)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                        <div class="relative">
                            <img src="{{ Storage::url($room->image_path) }}" 
                                alt="{{ $room->name }}" 
                                class="w-full h-64 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-full">
                                    ${{ number_format($room->price_per_night, 2) }}/night
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $room->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($room->description, 100) }}</p>
                            
                            <!-- Room Features -->
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex items-center text-gray-500">
                                    <i class="fas fa-user-friends mr-2"></i>
                                    <span>{{ $room->capacity }} Guests</span>
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <i class="fas fa-bed mr-2"></i>
                                    <span>{{ $room->bedType->name }}</span>
                                </div>
                            </div>

                            <!-- Amenities -->
                            <div class="mb-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($room->amenities->take(3) as $amenity)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <i class="fas fa-{{ $amenity->icon }} mr-1"></i>
                                            {{ $amenity->name }}
                                        </span>
                                    @endforeach
                                    @if($room->amenities->count() > 3)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            +{{ $room->amenities->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('rooms.show', $room) }}" 
                                class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-150 ease-in-out">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Rooms Button -->
            <div class="text-center mt-12">
                <a href="{{ route('rooms.browse') }}" 
                    class="inline-flex items-center px-8 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    View All Rooms
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div class="relative">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                        {{ $siteSettings['about_title'] ?? 'About Our Rentals' }}
                    </h2>
                    <p class="mt-3 text-lg text-gray-500">
                        {{ $siteSettings['about_content'] ?? 'Experience luxury and comfort in our carefully curated accommodations.' }}
                    </p>

                    <!-- Additional About Content -->
                    <div class="mt-8">
                        <dl class="space-y-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                        <i class="fas fa-hotel text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <dt class="text-lg leading-6 font-medium text-gray-900">
                                        Premium Locations
                                    </dt>
                                    <dd class="mt-2 text-base text-gray-500">
                                        All our properties are situated in prime locations, ensuring convenience and accessibility.
                                    </dd>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                        <i class="fas fa-concierge-bell text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <dt class="text-lg leading-6 font-medium text-gray-900">
                                        24/7 Service
                                    </dt>
                                    <dd class="mt-2 text-base text-gray-500">
                                        Our dedicated team is available round the clock to ensure your comfort and satisfaction.
                                    </dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-10 -mx-4 relative lg:mt-0">
                    <div class="relative mx-auto rounded-lg shadow-lg overflow-hidden">
                        <img 
                            class="w-full h-[500px] object-cover transform transition-transform duration-500 hover:scale-105" 
                            src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                            alt="Luxury Hotel Room"
                        >
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                            <p class="text-white text-lg font-semibold">Experience Luxury & Comfort</p>
                            <p class="text-gray-200 text-sm">Your perfect stay awaits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    {{ $siteSettings['features_title'] ?? 'Why Choose Us' }}
                </h2>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach(json_decode($siteSettings['features'] ?? '[]', true) ?? [] as $feature)
                        <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="flex-1 p-6">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                                    <i class="{{ $feature['icon'] ?? 'fas fa-star' }} text-indigo-600 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $feature['title'] ?? '' }}</h3>
                                <p class="text-gray-500">{{ $feature['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Rooms Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    {{ __('Featured Rooms') }}
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    {{ __('Discover our handpicked selection of premium accommodations') }}
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($featuredRooms as $room)
                    <div class="group relative overflow-hidden rounded-lg shadow-lg transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <!-- Room Image with Overlay -->
                        <div class="relative h-64">
                            <img class="h-full w-full object-cover" 
                                src="{{ Storage::url($room->image_path) }}" 
                                alt="{{ $room->name }}">
                            <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity group-hover:bg-opacity-30"></div>
                            <div class="absolute top-4 right-4 bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                ${{ number_format($room->price_per_night, 2) }}/night
                            </div>
                        </div>

                        <!-- Room Details -->
                        <div class="bg-white p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $room->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $room->apartmentType->name }}</p>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-user mr-1"></i>
                                    <span>{{ $room->capacity }} guests</span>
                                </div>
                            </div>

                            <!-- Room Features -->
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-bed mr-2"></i>
                                    <span>{{ $room->bedType->name }}</span>
                                </div>

                                <!-- Amenities Preview -->
                                <div class="flex flex-wrap gap-2">
                                    @foreach($room->amenities->take(3) as $amenity)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <i class="fas fa-{{ $amenity->icon }} mr-1"></i>
                                            {{ $amenity->name }}
                                        </span>
                                    @endforeach
                                    @if($room->amenities->count() > 3)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            +{{ $room->amenities->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-4">
                                <a href="{{ route('rooms.show', $room) }}" 
                                    class="block w-full text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('rooms.browse') }}" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150">
                    View All Rooms
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    {{ $siteSettings['testimonials_title'] ?? 'What Our Guests Say' }}
                </h2>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach(json_decode($siteSettings['testimonials'] ?? '[]', true) ?? [] as $testimonial)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <img class="h-12 w-12 rounded-full object-cover" 
                                        src="{{ isset($testimonial['photo']) && $testimonial['photo'] ? Storage::url($testimonial['photo']) : asset('images/default-avatar.jpg') }}" 
                                        alt="{{ $testimonial['name'] ?? 'Guest' }}">
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $testimonial['name'] ?? 'Guest' }}</h3>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="h-5 w-5 {{ $i <= ($testimonial['rating'] ?? 5) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic">{{ $testimonial['comment'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    {{ $siteSettings['contact_title'] ?? 'Get in Touch' }}
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    {{ $siteSettings['contact_subtitle'] ?? 'Have questions? We\'re here to help.' }}
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @if(isset($siteSettings['contact_email']) && $siteSettings['contact_email'])
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Email</h3>
                    <p class="mt-2 text-base text-gray-500">
                        <a href="mailto:{{ $siteSettings['contact_email'] }}" class="text-indigo-600 hover:text-indigo-500">
                            {{ $siteSettings['contact_email'] }}
                        </a>
                    </p>
                </div>
                @endif

                @if(isset($siteSettings['contact_phone']) && $siteSettings['contact_phone'])
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Phone</h3>
                    <p class="mt-2 text-base text-gray-500">
                        <a href="tel:{{ $siteSettings['contact_phone'] }}" class="text-indigo-600 hover:text-indigo-500">
                            {{ $siteSettings['contact_phone'] }}
                        </a>
                    </p>
                </div>
                @endif

                @if(isset($siteSettings['contact_address']) && $siteSettings['contact_address'])
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Address</h3>
                    <p class="mt-2 text-base text-gray-500">
                        {{ $siteSettings['contact_address'] }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Social Media Links -->
    @if(isset($siteSettings['social_links']) && is_array(json_decode($siteSettings['social_links'] ?? '[]', true)))
    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center space-x-6">
                @foreach(json_decode($siteSettings['social_links'] ?? '[]', true) as $social)
                    @if(isset($social['url']) && $social['url'])
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" 
                           class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">{{ $social['platform'] ?? 'Social Media' }}</span>
                            <i class="{{ $social['icon'] ?? 'fas fa-link' }} text-2xl"></i>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Custom Styles -->
    <style>
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>