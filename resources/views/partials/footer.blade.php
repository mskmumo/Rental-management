<footer class="bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="space-y-4 bg-blue-800/50 p-6 rounded-lg backdrop-blur-sm">
                <h3 class="text-xl font-semibold text-white border-b border-blue-600/50 pb-2">
                    About {{ config('app.name') }}
                </h3>
                <p class="text-blue-100 leading-relaxed">
                    {{ Str::limit($siteSettings['about_content'] ?? 'Experience luxury and comfort in our carefully curated accommodations. We provide exceptional service and memorable stays for all our guests.', 150) }}
                </p>
                <div class="pt-4">
                    <a href="{{ route('about') }}" 
                        class="inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-600 text-white rounded-lg transition duration-300 group">
                        Learn More 
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4 bg-blue-800/50 p-6 rounded-lg backdrop-blur-sm">
                <h3 class="text-xl font-semibold text-white border-b border-blue-600/50 pb-2">Quick Links</h3>
                <ul class="space-y-3">
                    @foreach([
                        ['route' => 'rooms.browse', 'text' => 'Browse Rooms', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['route' => 'about', 'text' => 'About Us', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['route' => 'contact', 'text' => 'Contact', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['route' => 'privacy', 'text' => 'Privacy Policy', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
                        ['route' => 'terms', 'text' => 'Terms of Service', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z']
                    ] as $link)
                        <li>
                            <a href="{{ route($link['route']) }}" 
                                class="group flex items-center p-2 rounded-lg hover:bg-blue-700/50 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                                </svg>
                                <span class="text-blue-100 group-hover:text-white">{{ $link['text'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4 bg-blue-800/50 p-6 rounded-lg backdrop-blur-sm">
                <h3 class="text-xl font-semibold text-white border-b border-blue-600/50 pb-2">Contact Info</h3>
                <ul class="space-y-4">
                    <li class="flex items-start transform hover:translate-x-2 transition-transform duration-300">
                        <div class="flex-shrink-0 bg-blue-700/50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-white">Address</p>
                            <p class="text-blue-200">123 Hotel Street</p>
                            <p class="text-blue-200">City, Country</p>
                        </div>
                    </li>
                    <li class="flex items-start transform hover:translate-x-2 transition-transform duration-300">
                        <div class="flex-shrink-0 bg-blue-700/50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-white">Phone</p>
                            <p class="text-blue-200">+1 234 567 890</p>
                        </div>
                    </li>
                    <li class="flex items-start transform hover:translate-x-2 transition-transform duration-300">
                        <div class="flex-shrink-0 bg-blue-700/50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-white">Email</p>
                            <p class="text-blue-200">info@example.com</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4 bg-blue-800/50 p-6 rounded-lg backdrop-blur-sm">
                <h3 class="text-xl font-semibold text-white border-b border-blue-600/50 pb-2">Newsletter</h3>
                <p class="text-blue-100">Subscribe to our newsletter for updates and exclusive offers.</p>
                <form class="mt-4" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="flex">
                        <input type="email" 
                            class="flex-1 px-4 py-2 rounded-l-lg bg-blue-900/50 border border-blue-700 text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Your email">
                        <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-r-lg hover:from-blue-500 hover:to-blue-400 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Subscribe
                        </button>
                    </div>
                </form>

                <!-- Social Links -->
                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-white mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        @foreach([
                            ['name' => 'Facebook', 'icon' => 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z'],
                            ['name' => 'Twitter', 'icon' => 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84'],
                            ['name' => 'Instagram', 'icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z']
                        ] as $social)
                            <a href="#" 
                                class="bg-blue-700/50 p-2 rounded-lg hover:bg-blue-600/50 transform hover:scale-110 transition-all duration-300">
                                <span class="sr-only">{{ $social['name'] }}</span>
                                <svg class="h-5 w-5 text-blue-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $social['icon'] }}"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="py-4 border-t border-blue-700/50">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-blue-200 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
                <div class="mt-4 md:mt-0">
                    <ul class="flex space-x-4 text-sm">
                        <li>
                            <a href="{{ route('privacy') }}" 
                                class="text-blue-200 hover:text-white transition duration-300">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" 
                                class="text-blue-200 hover:text-white transition duration-300">
                                Terms of Service
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer> 