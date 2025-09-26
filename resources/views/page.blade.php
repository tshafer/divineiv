@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title . ' - Divine IV and Wellness | Chandler, AZ')

@section('description', $page->meta_description ?: $page->excerpt)

@section('content')
<!-- Hero Section -->
@if($page->featured_image)
<section class="relative bg-cover bg-center bg-no-repeat py-20" style="background-image: url('{{ $page->featured_image }}'); min-height: 400px;">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center text-white">
        <h1 class="text-5xl font-bold mb-6">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $page->excerpt }}</p>
        @endif
    </div>
</section>
@else
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $page->excerpt }}</p>
        @endif
    </div>
</section>
@endif

<!-- Page Content -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="text-gray-600 leading-relaxed">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>
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
