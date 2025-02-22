<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Our Gallery</h2>
            <p class="mt-4 text-lg text-gray-600">Take a visual tour of our beautiful accommodations</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['image' => 'gallery/room1.jpg', 'title' => 'Luxury Suite'],
                ['image' => 'gallery/room2.jpg', 'title' => 'Ocean View Room'],
                ['image' => 'gallery/room3.jpg', 'title' => 'Executive Suite'],
                ['image' => 'gallery/amenity1.jpg', 'title' => 'Swimming Pool'],
                ['image' => 'gallery/amenity2.jpg', 'title' => 'Restaurant'],
                ['image' => 'gallery/amenity3.jpg', 'title' => 'Spa Center'],
            ] as $item)
            <div class="group relative overflow-hidden rounded-lg shadow-lg">
                <img 
                    src="{{ asset($item['image']) }}" 
                    alt="{{ $item['title'] }}"
                    class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">{{ $item['title'] }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('gallery') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                View All Photos
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section> 