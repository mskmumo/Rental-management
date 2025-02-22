<section class="bg-blue-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Subscribe to Our Newsletter</h2>
            <p class="text-blue-100 mb-8">Get the latest updates and special offers</p>
            
            <form action="{{ route('newsletter.subscribe') }}" method="POST" 
                class="max-w-md mx-auto flex gap-4">
                @csrf
                <input type="email" name="email" required placeholder="Enter your email" 
                    class="flex-1 rounded-lg px-4 py-2">
                <button type="submit" 
                    class="bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section> 