@extends('layouts.app')

@section('title', 'Services - Divine IV and Wellness | Chandler, AZ Med Spa')

@section('description', 'Comprehensive wellness and aesthetic services at Divine IV and Wellness in Chandler, AZ. IV therapy, hormone replacement therapy, skin treatments, and cosmetic injections.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Our Services</h1>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Discover our comprehensive range of wellness and aesthetic treatments designed to help you achieve your health and beauty goals.
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="service-card bg-gray-50 rounded-lg p-8 shadow-md">
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $service->title }}</h3>
                    <p class="text-gray-600 mb-6">{{ $service->description }}</p>
                    <a href="{{ route('service', $service->slug) }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                        Learn More
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Start Your Wellness Journey?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Contact us today to schedule your consultation and discover how our services can help you achieve your goals.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('page', 'contact-us') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                Schedule Consultation
            </a>
            <a href="tel:480-488-9858" class="border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                Call Now: 480-488-9858
            </a>
        </div>
    </div>
</section>
@endsection
