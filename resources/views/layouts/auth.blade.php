<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pahali Pazuri') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            <!-- Auth Header -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Logo and Name -->
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Pahali Pazuri Logo">
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Pahali Pazuri</h1>
                                <p class="text-sm text-gray-500">Your Premier Rental Destination</p>
                            </div>
                        </div>

                        <!-- Why Choose Us Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span>Why Choose Us</span>
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" 
                                @click.away="open = false"
                                class="absolute right-0 mt-2 w-96 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95">
                                <div class="p-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Welcome to Pahali Pazuri</h3>
                                    
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-star text-indigo-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Premium Accommodations</h4>
                                                <p class="text-sm text-gray-500">Carefully curated selection of high-quality rental properties.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-shield-alt text-indigo-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Secure Booking</h4>
                                                <p class="text-sm text-gray-500">Safe and transparent booking process with instant confirmation.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-headset text-indigo-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">24/7 Support</h4>
                                                <p class="text-sm text-gray-500">Dedicated customer service team ready to assist you anytime.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-gift text-indigo-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Loyalty Rewards</h4>
                                                <p class="text-sm text-gray-500">Earn points with every booking and enjoy exclusive benefits.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="py-12">
                {{ $slot }}
            </main>

            <!-- Simple Footer -->
            <footer class="bg-white border-t border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                        © {{ date('Y') }} Pahali Pazuri. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html> 