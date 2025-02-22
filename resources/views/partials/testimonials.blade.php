<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-2">What Our Guests Say</h2>
            <div class="flex items-center justify-center mb-8">
                <span class="text-yellow-400 text-2xl">★★★★★</span>
                <span class="ml-2 text-gray-600">4.8/5 from 1,000+ bookings</span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($siteSettings['testimonials'] as $testimonial)
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        @if(isset($testimonial['photo']))
                            <img src="{{ Storage::url($testimonial['photo']) }}" 
                                alt="{{ $testimonial['name'] }}" 
                                class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 text-xl font-bold">
                                    {{ substr($testimonial['name'], 0, 1) }}
                                </span>
                            </div>
                        @endif
                        <div class="ml-4">
                            <h4 class="font-semibold">{{ $testimonial['name'] }}</h4>
                            <div class="text-yellow-400">
                                @for($i = 0; $i < $testimonial['rating']; $i++)★@endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">{{ $testimonial['comment'] }}</p>
                </div>
            @empty
                @foreach([
                    ['name' => 'John Doe', 'comment' => 'Amazing experience! The place was exactly as described.'],
                    ['name' => 'Jane Smith', 'comment' => 'Very comfortable and clean rooms. Would definitely stay again.'],
                    ['name' => 'Mike Johnson', 'comment' => 'Great location and friendly staff. Highly recommended!']
                ] as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 text-xl font-bold">
                                    {{ substr($testimonial['name'], 0, 1) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-semibold">{{ $testimonial['name'] }}</h4>
                                <div class="text-yellow-400">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600">{{ $testimonial['comment'] }}</p>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section> 