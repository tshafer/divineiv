@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title . ' - Divine IV and Wellness | Chandler, AZ')

@section('description', $page->meta_description ?: $page->excerpt)

@section('content')
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            offset: 100,
            once: true,
            easing: 'ease-in-out'
        });
    });
</script>

<!-- Enhanced Hero Section -->
@if($page->featured_image)
<section class="relative bg-cover bg-center bg-no-repeat py-20 lg:py-32" 
         style="background-image: url('{{ $page->featured_image }}'); min-height: 500px;"
         data-aos="fade-up">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="max-w-7xl mx-auto px-4 text-center text-white relative z-10">
        <!-- Badge -->
        <div class="flex justify-center mb-6" data-aos="fade-in" data-aos-delay="200">
            <div class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3 backdrop-blur-sm">
                <div class="w-6 h-6 bg-cyan-300 rounded-full mr-3"></div>
                <span class="text-cyan-200 font-semibold">Page Preview</span>
            </div>
        </div>
        
        <!-- Title -->
        <h1 class="heading-font text-5xl lg:text-7xl font-bold mb-6" data-aos="fade-up" data-aos-delay="300">
            {!! ($page->hero_title) ?: $page->title !!}
        </h1>
        
        @if($page->hero_subtitle || $page->excerpt)
        <p class="text-xl lg:text-2xl mb-12 max-w-3xl mx-auto text-white/90 leading-relaxed" data-aos="fade-up" data-aos-delay="500">
            {!! ($page->hero_subtitle) ?: $page->excerpt !!}
        </p>
        @endif
        
        @if($page->show_hero_cards && is_array($page->action_cards) && count($page->action_cards) > 0)
        <!-- Custom Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-{{ min(count($page->action_cards), 3) }} gap-8 mt-12" data-aos="fade-up" data-aos-delay="700">
            @foreach($page->action_cards as $card)
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6 transform hover:scale-105 transition-all duration-500 hover:bg-white/20">
                @if($card['icon'] ?? null)
                <i class="{{ $card['icon'] ?? 'fas fa-arrow-right' }} text-cyan-300 text-2xl mb-3"></i>
                @endif
                <h3 class="text-xl font-semibold mb-2">{{ $card['title'] ?? 'Action' }}</h3>
                @if(array_key_exists('url', $card) && !empty($card['url']))
                <a href="{{ $card['url'] }}" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg transition-colors">
                    {{ $card['title'] ?? 'Learn More' }}
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @elseif($page->show_hero_cards !== false)
        <!-- Default Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12" data-aos="fade-up" data-aos-delay="700">
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6 transform hover:scale-105 transition-all duration-500 hover:bg-white/20">
                <i class="fas fa-calendar-check text-cyan-300 text-2xl mb-3"></i>
                <h3 class="text-xl font-semibold mb-2">Schedule Today</h3>
                <p class="text-cyan-100">Ready to start your wellness journey?</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6 transform hover:scale-105 transition-all duration-500 hover:bg-white/20">
                <i class="fas fa-user-md text-cyan-300 text-2xl mb-3"></i>
                <h3 class="text-xl font-semibold mb-2">Expert Care</h3>
                <p class="text-cyan-100">Professional medical spa team</p>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6 transform hover:scale-105 transition-all duration-500 hover:bg-white/20">
                <i class="fas fa-location-dot text-cyan-300 text-2xl mb-3"></i>
                <h3 class="text-xl font-semibold mb-2">Chandler Location</h3>
                <p class="text-cyan-100">Convenient AZ location</p>
            </div>
        </div>
        @endif
    </div>
</section>
@else
<x-hero
    :title="$page->hero_title ?: $page->title"
    :description="$page->hero_subtitle ?: $page->excerpt"
    :highlights="[
        'badge_text' => 'Page Preview',
        'cards' => [
            [
                'icon' => 'fas fa-calendar-check text-cyan-300 text-2xl mb-3',
                'title' => 'Schedule Today',
                'content' => 'Ready to start your wellness journey?'
            ],
            [
                'icon' => 'fas fa-user-md text-cyan-300 text-2xl mb-3',
                'title' => 'Expert Care',
                'content' => 'Professional medical spa team'
            ],
            [
                'icon' => 'fas fa-location-dot text-cyan-300 text-2xl mb-3',
                'title' => 'Chandler Location',
                'content' => 'Convenient AZ location'
            ]
        ]
    ]"
/>
@endif

<!-- Page Content Section -->
<section class="py-10 bg-white" data-aos="fade-up" id="main-content">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        @if($page->content_layout === 'full_width')
            <!-- Full Width Layout -->
            <div class="prose prose-lg max-w-none mx-auto">
                <h2 class="heading-font text-3xl font-bold text-slate-800 mb-6" data-aos="fade-up" data-aos-delay="200">Content Details</h2>
                <div class="text-gray-600 leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                    {!! nl2br(e($page->content)) !!}
                </div>
            </div>
        @elseif($page->content_layout === 'centered')
            <!-- Centered Layout -->
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg max-w-none">
                    <h2 class="heading-font text-3xl font-bold text-slate-800 mb-6 text-center" data-aos="fade-up" data-aos-delay="200">Content Details</h2>
                    <div class="text-gray-600 leading-relaxed text-center" data-aos="fade-up" data-aos-delay="300">
                        {!! nl2br(e($page->content)) !!}
                    </div>
                </div>
            </div>
        @else
            <!-- Two Column Layout (Default) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <!-- Main Content -->
                <div class="prose prose-lg max-w-none">
                    <h2 class="heading-font text-3xl font-bold text-slate-800 mb-6" data-aos="fade-up" data-aos-delay="200">Content Details</h2>
                    <div class="text-gray-600 leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                        {!! nl2br(e($page->content)) !!}
                    </div>
                </div>

                <!-- Quick Actions Sidebar -->
                @if($page->show_contact_sidebar)
                <div class="space-y-6">
                    <!-- Contact Information Card -->
                    <x-contact-info
                        :hours="[
                            'Mon, Wed-Fri: 9 AM - 5 PM',
                            'Tuesday: Closed',
                            'Lunch: 12-1:30 PM (except Tue)'
                        ]"
                    />

                    <!-- Dynamic Action Cards from Admin -->
                    @if(is_array($page->action_cards) && count($page->action_cards) > 0)
                        <x-quick-actions
                            :actions="$page->action_cards"
                        />
                    @else
                    <!-- Default Quick Actions -->
                    <x-quick-actions
                        :actions="[
                            [
                                'label' => 'Call Now',
                                'url' => 'tel:480-488-9858',
                                'icon' => 'fas fa-phone',
                                'variant' => 'primary'
                            ],
                            [
                                'label' => 'View Services',
                                'url' => route('services'),
                                'icon' => 'fas fa-th-large',
                                'variant' => 'secondary'
                            ],
                            [
                                'label' => 'Request Consultation',
                                'url' => route('page', 'contact-us'),
                                'icon' => 'fas fa-calendar',
                                'variant' => 'primary'
                            ]
                        ]"
                    />
                    @endif
                </div>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Special Navigation Cards for About Us Page -->
@if($page->slug === 'about-us')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Our Provider Card -->
            <a href="{{ route('page', 'amy-berkhout') }}" class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 bg-cover bg-center bg-no-repeat" style="background-image: url('/images/our-provider.png');"></div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Our Provider</h3>
                    <p class="text-gray-600">Meet Amy Berkhout, FNP-BC and our team of experts.</p>
                </div>
            </a>

            <!-- Our Services Card -->
            <a href="{{ route('services') }}" class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 bg-cover bg-center bg-no-repeat" style="background-image: url('/images/our-services.png');"></div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Our Services</h3>
                    <p class="text-gray-600">Explore our comprehensive range of wellness treatments.</p>
                </div>
            </a>

            <!-- Our Office Card -->
            <a href="{{ route('page', 'contact-us') }}" class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-48 bg-cover bg-center bg-no-repeat" style="background-image: url('/images/our-office.png');"></div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Our Office</h3>
                    <p class="text-gray-600">Visit our modern facility in Chandler, AZ.</p>
                </div>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
@if($page->slug !== 'contact-us' && $page->slug !== 'about-us')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Get Started?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Contact us today to schedule your consultation and begin your wellness journey.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('page', 'contact-us') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                Contact Us
            </a>
            <a href="{{ route('services') }}" class="border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                View Our Services
            </a>
        </div>
    </div>
</section>
@endif
@endsection
