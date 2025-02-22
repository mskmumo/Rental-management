<nav class="bg-white shadow-lg fixed w-full z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center">
                    <img src="https://raw.githubusercontent.com/mshaikh0707/rental_images/main/logo.png" 
                        alt="Logo" class="h-12 w-auto">
                    <span class="ml-3 text-xl font-bold text-gray-800">{{ config('app.name') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <!-- Homepage Sections -->
                @if(request()->is('/'))
                    <a href="#featured-properties" 
                        class="text-gray-600 hover:text-blue-600 transition scroll-smooth">
                        Featured
                    </a>
                    <a href="#how-it-works" 
                        class="text-gray-600 hover:text-blue-600 transition scroll-smooth">
                        How It Works
                    </a>
                    <a href="#testimonials" 
                        class="text-gray-600 hover:text-blue-600 transition scroll-smooth">
                        Testimonials
                    </a>
                @endif

                <!-- Main Navigation -->
                <a href="{{ route('rooms.browse') }}" 
                    class="text-gray-600 hover:text-blue-600 transition">
                    Browse Rooms
                </a>
                <a href="{{ route('about') }}" 
                    class="text-gray-600 hover:text-blue-600 transition">
                    About Us
                </a>
                <a href="{{ route('contact') }}" 
                    class="text-gray-600 hover:text-blue-600 transition">
                    Contact
                </a>

                <!-- Auth Navigation -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                            class="flex items-center space-x-2 hover:opacity-80 transition">
                            <img src="{{ auth()->user()->avatar ?? 'https://placehold.co/100x100?text=User' }}" 
                                class="h-10 w-10 rounded-full border-2 border-blue-500">
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" 
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2">
                            @if(auth()->user()->usertype === 'admin')
                                <a href="{{ route('admin.dashboard') }}" 
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" 
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">
                                    <i class="fas fa-user mr-2"></i> My Dashboard
                                </a>
                            @endif
                            
                            <a href="{{ route('profile.edit') }}" 
                                class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">
                                <i class="fas fa-user-edit mr-2"></i> Profile
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" 
                        class="text-gray-600 hover:text-gray-900 transition">Login</a>
                    <a href="{{ route('register') }}" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition">
                        Sign Up
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="text-gray-500 hover:text-gray-600">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" 
        class="md:hidden bg-white border-t border-gray-200"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4">
        
        <!-- Homepage Sections (Only shown on homepage) -->
        @if(request()->is('/'))
            <div class="px-2 pt-2 pb-3 space-y-1 border-b border-gray-200">
                <a href="#featured-properties" 
                    class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition"
                    @click="mobileMenuOpen = false">
                    Featured Properties
                </a>
                <a href="#how-it-works" 
                    class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition"
                    @click="mobileMenuOpen = false">
                    How It Works
                </a>
                <a href="#testimonials" 
                    class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition"
                    @click="mobileMenuOpen = false">
                    Testimonials
                </a>
            </div>
        @endif

        <!-- Main Navigation -->
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('rooms.browse') }}" 
                class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition">
                Browse Rooms
            </a>
            <a href="{{ route('about') }}" 
                class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition">
                About Us
            </a>
            <a href="{{ route('contact') }}" 
                class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition">
                Contact
            </a>
        </div>

        <!-- Mobile Auth Menu -->
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img src="{{ auth()->user()->avatar ?? 'https://placehold.co/100x100?text=User' }}" 
                            class="h-10 w-10 rounded-full">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <a href="{{ auth()->user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                        class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition">
                        Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                        class="block px-3 py-2 text-gray-700 hover:bg-gray-50 transition">
                        Profile Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="block w-full text-left px-3 py-2 text-red-600 hover:bg-red-50 transition">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="px-4 py-3 border-t border-gray-200">
                <a href="{{ route('login') }}" 
                    class="block text-center py-2 px-4 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                    class="block text-center mt-2 py-2 px-4 rounded-md text-gray-700 bg-gray-50 hover:bg-gray-100 transition">
                    Sign Up
                </a>
            </div>
        @endauth
    </div>
</nav>

@push('scripts')
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush 