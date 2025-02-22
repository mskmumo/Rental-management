<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">
            {{ $siteSettings['featured_section_title'] }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredRooms as $index => $room)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $index * 100 }}">
                    <img src="{{ Storage::url($room->image_path) }}" alt="{{ $room->name }}" 
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold">{{ $room->name }}</h3>
                        <p class="mt-2 text-gray-600">{{ Str::limit($room->description, 100) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">${{ $room->price_per_night }}/night</span>
                            <a href="{{ route('rooms.show', $room) }}" 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">No featured properties available at the moment.</p>
            @endforelse
        </div>
    </div>
</section> 