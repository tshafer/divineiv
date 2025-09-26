@extends('layouts.app')

@section('title', 'Services - Divine IV and Wellness | Chandler, AZ Med Spa')

@section('description', 'Comprehensive wellness and aesthetic services at Divine IV and Wellness in Chandler, AZ. IV therapy, hormone replacement therapy, skin treatments, and cosmetic injections.')

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
<x-hero
    title='Complete <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Wellness & Beauty</span> Services'
    description="Discover our comprehensive range of wellness and aesthetic treatments, designed to help you achieve your optimal health and beauty goals through professional, personalized care."
    class="hero-section"
    :highlights="[
        'badge_text' => 'Professional Treatments',
        'cards' => [
            [
                'icon' => 'fas fa-user-md text-cyan-300 text-2xl mb-3',
                'title' => 'Expert Care',
                'content' => 'Professional medical spa team'
            ],
            [
                'icon' => 'fas fa-calendar-check text-cyan-300 text-2xl mb-3',
                'title' => 'Schedule Today',
                'content' => 'Ready to start your wellness journey?'
            ],
            [
                'icon' => 'fas fa-location-dot text-cyan-300 text-2xl mb-3',
                'title' => 'Chandler Location',
                'content' => 'Convenient AZ location'
            ]
        ]
    ]"
/>

<!-- Services Grid -->
<section class="py-20 bg-gradient-to-b from-slate-50 to-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!-- Services Header -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="200">
            <h2 class="heading-font text-4xl font-bold text-slate-800 mb-4">Our Specialized Treatments</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Choose from our comprehensive range of wellness and aesthetic treatments, each designed
                with your individual goals in mind.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="400">
            @foreach($services as $index => $service)
            <div class="modern-card text-center group" data-aos="fade-up" data-aos-delay="{{ 600 + ($index * 100) }}">
                <div class="mb-8">
                    @if($service->image)
                        <div class="mb-6">
                            <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-24 h-24 rounded-3xl object-cover mx-auto shadow-xl">
                        </div>
                    @else
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-xl">
                            <i class="{{ $service->icon ?: 'fas fa-heart' }} text-white text-3xl"></i>
                        </div>
                    @endif
                    <h3 class="heading-font text-2xl lg:text-3xl font-bold text-gray-800 mb-4">{{ $service->title }}</h3>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6 line-clamp-3">{{ $service->description }}</p>
                </div>
                <a href="{{ route('service', $service->slug) }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-full font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center group">
                    <i class="fas fa-eye mr-3"></i>
                    Learn More
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 hero-gradient text-white relative overflow-hidden" data-aos="fade-up">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-20 w-32 h-32 border border-white rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 border border-white rounded-full"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 border border-white rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-center mb-6" data-aos="fade-in" data-aos-delay="200">
                <div class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3 backdrop-blur-sm">
                    <div class="w-6 h-6 bg-cyan-300 rounded-full mr-3"></div>
                    <span class="text-cyan-200 font-semibold">Schedule Your Visit</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-6xl font-bold mb-6" data-aos="fade-up" data-aos-delay="300">
                Ready to Start Your
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Wellness Journey?</span>
            </h2>
            <p class="text-xl lg:text-2xl text-blue-100 mb-12 leading-relaxed" data-aos="fade-up" data-aos-delay="500">
                Contact us today to schedule your personalized consultation and discover how our treatments
                can help you achieve your health and beauty goals.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center" data-aos="fade-up" data-aos-delay="700">
                <a href="{{ route('page', 'contact-us') }}" class="bg-white text-blue-600 px-10 py-5 rounded-full font-semibold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center group">
                    <i class="fas fa-calendar-check mr-3"></i>
                    Schedule Consultation
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="tel:480-488-9858" class="border-2 border-white text-white px-10 py-5 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 flex items-center group">
                    <i class="fas fa-headset mr-3"></i>
                    Call: (480) 488-9858
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
