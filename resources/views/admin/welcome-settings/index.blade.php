<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome Page Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.welcome-settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hero Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Hero Section</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="hero_title" :value="__('Hero Title')" />
                                    <x-text-input id="hero_title" name="hero_title" type="text" class="mt-1 block w-full" :value="old('hero_title', $settings['hero_title'])" />
                                    <x-input-error :messages="$errors->get('hero_title')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="hero_subtitle" :value="__('Hero Subtitle')" />
                                    <x-text-input id="hero_subtitle" name="hero_subtitle" type="text" class="mt-1 block w-full" :value="old('hero_subtitle', $settings['hero_subtitle'])" />
                                    <x-input-error :messages="$errors->get('hero_subtitle')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="hero_image" :value="__('Hero Background Image')" />
                                    <input id="hero_image" name="hero_image" type="file" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('hero_image')" class="mt-2" />
                                    @if($settings['hero_image'])
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($settings['hero_image']) }}" alt="Hero Image" class="h-32 w-auto object-cover rounded">
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <x-input-label for="hero_cta_text" :value="__('CTA Button Text')" />
                                    <x-text-input id="hero_cta_text" name="hero_cta_text" type="text" class="mt-1 block w-full" :value="old('hero_cta_text', $settings['hero_cta_text'])" />
                                    <x-input-error :messages="$errors->get('hero_cta_text')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="hero_cta_link" :value="__('CTA Button Link')" />
                                    <x-text-input id="hero_cta_link" name="hero_cta_link" type="text" class="mt-1 block w-full" :value="old('hero_cta_link', $settings['hero_cta_link'])" />
                                    <x-input-error :messages="$errors->get('hero_cta_link')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- About Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">About Section</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="about_title" :value="__('About Title')" />
                                    <x-text-input id="about_title" name="about_title" type="text" class="mt-1 block w-full" :value="old('about_title', $settings['about_title'])" />
                                    <x-input-error :messages="$errors->get('about_title')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="about_content" :value="__('About Content')" />
                                    <textarea id="about_content" name="about_content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="4">{{ old('about_content', $settings['about_content']) }}</textarea>
                                    <x-input-error :messages="$errors->get('about_content')" class="mt-2" />
                                </div>
                            
                            <div>
                                    <x-input-label for="about_image" :value="__('About Image')" />
                                    <input id="about_image" name="about_image" type="file" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('about_image')" class="mt-2" />
                                    @if($settings['about_image'])
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($settings['about_image']) }}" alt="About Image" class="h-32 w-auto object-cover rounded">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Features Section -->
                        <div class="mb-8" x-data="{ features: {{ json_encode($settings['features']) }} }">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Features Section</h3>
                            <div>
                                <x-input-label for="features_title" :value="__('Features Title')" />
                                <x-text-input id="features_title" name="features_title" type="text" class="mt-1 block w-full" :value="old('features_title', $settings['features_title'])" />
                                <x-input-error :messages="$errors->get('features_title')" class="mt-2" />
                            </div>

                            <div class="mt-4 space-y-4">
                                <template x-for="(feature, featureIndex) in features" :key="featureIndex">
                                    <div class="border p-4 rounded-lg">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <x-input-label :value="__('Icon Class')" />
                                                <x-text-input x-bind:name="'features[' + featureIndex + '][icon]'" type="text" class="mt-1 block w-full" x-model="feature.icon" />
                                            </div>
                                            <div>
                                                <x-input-label :value="__('Title')" />
                                                <x-text-input x-bind:name="'features[' + featureIndex + '][title]'" type="text" class="mt-1 block w-full" x-model="feature.title" />
                                            </div>
                                            <div>
                                                <x-input-label :value="__('Description')" />
                                                <textarea x-bind:name="'features[' + featureIndex + '][description]'" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" x-model="feature.description"></textarea>
                                            </div>
                                        </div>
                                        <button type="button" @click="features.splice(featureIndex, 1)" class="text-red-600 mt-2">
                                            Remove Feature
                                        </button>
                                    </div>
                                </template>

                                <button type="button" @click="features.push({icon: '', title: '', description: ''})" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    Add Feature
                                </button>
                            </div>
                        </div>

                        <!-- SEO Settings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="meta_title" :value="__('Meta Title')" />
                                    <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" :value="old('meta_title', $settings['meta_title'])" />
                                    <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="meta_description" :value="__('Meta Description')" />
                                    <textarea id="meta_description" name="meta_description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="3">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                                    <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="meta_keywords" :value="__('Meta Keywords')" />
                                    <x-text-input id="meta_keywords" name="meta_keywords" type="text" class="mt-1 block w-full" :value="old('meta_keywords', $settings['meta_keywords'])" />
                                    <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="contact_address" :value="__('Address')" />
                                    <textarea id="contact_address" name="contact_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="2">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                                    <x-input-error :messages="$errors->get('contact_address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="contact_phone" :value="__('Phone')" />
                                    <x-text-input id="contact_phone" name="contact_phone" type="text" class="mt-1 block w-full" :value="old('contact_phone', $settings['contact_phone'])" />
                                    <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="contact_email" :value="__('Email')" />
                                    <x-text-input id="contact_email" name="contact_email" type="email" class="mt-1 block w-full" :value="old('contact_email', $settings['contact_email'])" />
                                    <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Social Media Links</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="social_facebook" :value="__('Facebook URL')" />
                                    <x-text-input id="social_facebook" name="social_facebook" type="url" class="mt-1 block w-full" :value="old('social_facebook', $settings['social_facebook'])" />
                                    <x-input-error :messages="$errors->get('social_facebook')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="social_twitter" :value="__('Twitter URL')" />
                                    <x-text-input id="social_twitter" name="social_twitter" type="url" class="mt-1 block w-full" :value="old('social_twitter', $settings['social_twitter'])" />
                                    <x-input-error :messages="$errors->get('social_twitter')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="social_instagram" :value="__('Instagram URL')" />
                                    <x-text-input id="social_instagram" name="social_instagram" type="url" class="mt-1 block w-full" :value="old('social_instagram', $settings['social_instagram'])" />
                                    <x-input-error :messages="$errors->get('social_instagram')" class="mt-2" />
                            </div>

                                <div>
                                    <x-input-label for="social_linkedin" :value="__('LinkedIn URL')" />
                                    <x-text-input id="social_linkedin" name="social_linkedin" type="url" class="mt-1 block w-full" :value="old('social_linkedin', $settings['social_linkedin'])" />
                                    <x-input-error :messages="$errors->get('social_linkedin')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Save Settings') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Initialize Alpine.js components
        document.addEventListener('alpine:init', () => {
            Alpine.data('features', () => ({
                features: []
            }))
            Alpine.data('testimonials', () => ({
                testimonials: []
            }))
        })
    </script>
    @endpush
</x-app-layout> 