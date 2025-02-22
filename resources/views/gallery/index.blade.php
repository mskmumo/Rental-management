<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-8">Photo Gallery</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($images as $image)
                    <div class="relative group overflow-hidden rounded-lg shadow-lg">
                        <img src="{{ Storage::url($image->image_path) }}" 
                            alt="{{ $image->title }}" 
                            class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        
                        @if($image->title)
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-white">{{ $image->title }}</h3>
                                    @if($image->description)
                                        <p class="text-gray-200 mt-2">{{ $image->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $images->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 