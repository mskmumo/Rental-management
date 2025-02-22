<section id="how-it-works" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">
            How It Works
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(['Search', 'Book', 'Enjoy'] as $index => $step)
                <div class="text-center" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $index * 200 }}">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto
                        transform transition-all duration-300 hover:scale-110 hover:rotate-12">
                        <!-- Icons and content -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> 