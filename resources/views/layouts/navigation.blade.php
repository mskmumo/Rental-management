<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/pahali-pazuri.png') }}" alt="Pahali Pazuri Logo" class="h-12 w-12 rounded-full shadow-lg animate-spin-slow logo-hover-pause">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(Auth::user()->usertype == 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <!-- Admin Navigation -->
                            <x-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')">
                                {{ __('Rooms') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')">
                                {{ __('Bookings') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.contact-messages.index')" :active="request()->routeIs('admin.contact-messages.*')">
                                {{ __('Contact Messages') }}
                            </x-nav-link>
                            <!-- Reports Dropdown -->
                            <div class="hidden sm:flex sm:items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 {{ request()->routeIs('admin.reports.*') ? 'border-indigo-400' : 'border-transparent' }}">
                                            <div>{{ __('Reports') }}</div>
                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('admin.reports.bookings')" :active="request()->routeIs('admin.reports.bookings')">
                                            {{ __('Booking Reports') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.reports.revenue')" :active="request()->routeIs('admin.reports.revenue')">
                                            {{ __('Revenue Reports') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('admin.reports.occupancy')" :active="request()->routeIs('admin.reports.occupancy')">
                                            {{ __('Occupancy Reports') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                            <x-nav-link :href="route('admin.welcome-settings.index')" :active="request()->routeIs('admin.welcome-settings.*')">
                                {{ __('Welcome Page Settings') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('rooms.browse')" :active="request()->routeIs('rooms.browse')">
                                {{ __('Browse Rooms') }}
                            </x-nav-link>
                            <x-nav-link :href="route('client.bookings.index')" :active="request()->routeIs('client.bookings.*')">
                                {{ __('My Bookings') }}
                            </x-nav-link>
                        @endif
                    @else
                        <x-nav-link :href="route('rooms.browse')" :active="request()->routeIs('rooms.browse')">
                            {{ __('Browse Rooms') }}
                        </x-nav-link>
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Setti
                ngs Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(Auth::user()->usertype == 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <!-- Admin Navigation -->
                    <x-responsive-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')">
                        {{ __('Rooms') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')">
                        {{ __('Bookings') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.contact-messages.index')" :active="request()->routeIs('admin.contact-messages.*')">
                        {{ __('Contact Messages') }}
                    </x-responsive-nav-link>
                    <!-- Mobile Reports Menu -->
                    <div class="pt-2 pb-3 space-y-1">
                        <div class="ps-3 text-gray-600 text-sm font-medium">{{ __('Reports') }}</div>
                        <x-responsive-nav-link :href="route('admin.reports.bookings')" :active="request()->routeIs('admin.reports.bookings')">
                            {{ __('Booking Reports') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.reports.revenue')" :active="request()->routeIs('admin.reports.revenue')">
                            {{ __('Revenue Reports') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.reports.occupancy')" :active="request()->routeIs('admin.reports.occupancy')">
                            {{ __('Occupancy Reports') }}
                        </x-responsive-nav-link>
                    </div>
                    <x-responsive-nav-link :href="route('admin.welcome-settings.index')" :active="request()->routeIs('admin.welcome-settings.*')">
                        {{ __('Welcome Page Settings') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('rooms.browse')" :active="request()->routeIs('rooms.browse')">
                        {{ __('Browse Rooms') }}
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link :href="route('rooms.browse')" :active="request()->routeIs('rooms.browse')">
                    {{ __('Browse Rooms') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
