@extends('layouts.app')

@section('title', 'Divine IV and Wellness - Chandler, AZ Med Spa | Your Expression of Natural Beauty')

@section('description', 'Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout, specializing in IV therapy, hormone replacement therapy, weight loss, and aesthetic treatments.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Med Spa Chandler, AZ</h1>
        <h2 class="text-3xl mb-8">Your Expression of Natural Beauty</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Welcome to Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout,
            our practice specializes in IV therapy, hormone replacement therapy, weight loss, thyroid disorder,
            RF skin tightening and dermabrasion.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('services') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Our Services
            </a>
            <a href="{{ route('page', 'contact-us') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition duration-300">
                Schedule Consultation
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Featured Technologies and Services</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Employing modern technologies and some of the most cutting-edge techniques available,
                the Divine IV and Wellness team provides a range of high-quality services and treatments.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($services as $service)
            <div class="service-card bg-gray-50 rounded-lg p-6 shadow-md">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $service->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                    <a href="{{ route('service', $service->slug) }}" class="text-purple-600 font-semibold hover:text-purple-800 transition duration-300">
                        Learn More <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                All Services
            </a>
        </div>
    </div>
</section>

<!-- About Section -->
@if($aboutPage)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Meet Amy Berkhout</h2>
                <p class="text-lg text-gray-600 mb-6">
                    Amy Berkhout, FNP-BC is a family nurse practitioner with expertise in hormone replacement therapy,
                    aesthetics, and IV infusion therapy to allow Chandler, AZ area patients to reach their personal
                    aesthetic and wellness goals.
                </p>
                <p class="text-gray-600 mb-8">
                    With a background in nursing and health promotion, Amy is ready to provide you with the
                    distinguished level of care that you want and deserve.
                </p>
                <a href="{{ route('page', 'amy-berkhout') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                    Learn More About Amy
                </a>
            </div>
            <div class="text-center">
                <div class="w-80 h-80 bg-purple-200 rounded-full mx-auto flex items-center justify-center">
                    <i class="fas fa-user-md text-purple-600 text-8xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Reviews Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Featured Reviews</h2>
            <div class="flex justify-center items-center mb-8">
                <div class="flex text-yellow-400 text-2xl mr-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">5.0</span>
                <span class="text-gray-600 ml-2">Average Rating</span>
            </div>
            <p class="text-xl text-gray-600">177 Total Reviews</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($reviews as $review)
            <div class="bg-gray-50 rounded-lg p-6 shadow-md">
                <div class="flex text-yellow-400 mb-4">
                    @for($i = 0; $i < $review->rating; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p class="text-gray-600 mb-4 italic">"{{ $review->content }}"</p>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-800">{{ $review->author_name }}</span>
                    @if($review->source)
                        <span class="text-sm text-gray-500">{{ $review->source }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('reviews') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                All Reviews
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Contact Information</h2>
            <p class="text-xl text-gray-300">Ready to start your wellness journey?</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Address</h3>
                <p class="text-gray-300">3930 S Alma School Rd Suite 10</p>
                <p class="text-gray-300">Chandler, AZ 85248</p>
            </div>
            <div>
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Phone</h3>
                <a href="tel:480-488-9858" class="text-purple-300 hover:text-white transition duration-300">480-488-9858</a>
            </div>
            <div>
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Schedule</h3>
                <a href="{{ route('page', 'contact-us') }}" class="text-purple-300 hover:text-white transition duration-300">Book Consultation</a>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('page', 'contact-us') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
