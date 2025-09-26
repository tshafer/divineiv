@extends('layouts.app')

@section('title', 'Reviews - Divine IV and Wellness | Chandler, AZ Med Spa')

@section('description', 'Read what our patients say about Divine IV and Wellness in Chandler, AZ. Real reviews from satisfied patients who have experienced our IV therapy, aesthetic treatments, and wellness services.')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20 lg:py-32 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-20 w-32 h-32 border border-white rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 border border-white rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3">
                    <i class="fas fa-star text-cyan-300 mr-3"></i>
                    <span class="text-cyan-200 font-semibold">Client Testimonials</span>
                </div>
            </div>
            <h1 class="heading-font text-5xl lg:text-7xl font-bold mb-6">
                Patient
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Reviews</span>
            </h1>
            <p class="text-xl lg:text-2xl mb-12 max-w-3xl mx-auto text-white/90 leading-relaxed">
                See what our patients are saying about their transformative experience at Divine IV and Wellness.
            </p>
            <div class="flex justify-center items-center">
                <div class="flex text-yellow-300 text-4xl mr-8">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text-center">
                    <span class="text-5xl font-bold heading-font block">5.0</span>
                    <span class="text-xl text-cyan-200">Average Rating</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Grid -->
<section class="py-20 bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($reviews as $review)
            <div class="modern-card text-center group">
                <!-- Stars -->
                <div class="flex justify-center text-yellow-400 mb-6">
                    @for($i = 0; $i < $review->rating; $i++)
                        <i class="fas fa-star text-2xl"></i>
                    @endfor
                </div>

                <!-- Quote -->
                <blockquote class="text-gray-700 text-xl leading-relaxed mb-8 italic relative">
                    <i class="fas fa-quote-left text-blue-400 text-4xl mb-4 block"></i>
                    "{{ $review->content }}"
                </blockquote>

                <!-- Author Info -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            {{ strtoupper(substr($review->author_name, 0, 1)) }}
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-bold text-gray-800 heading-font text-lg">{{ $review->author_name }}</div>
                            @if($review->source)
                                <div class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    {{ $review->source }}
                                </div>
                            @endif
                            <div class="text-sm text-gray-400 mt-1">
                                {{ $review->created_at->format('M j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 hero-gradient text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-40 h-40 border border-white rounded-full"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 border border-white rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3">
                    <i class="fas fa-heart text-cyan-300 mr-3"></i>
                    <span class="text-cyan-200 font-semibold">Join Our Family</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-6xl font-bold mb-6">
                Ready to Experience Our
                <span class="text-cyan-300">Care?</span>
            </h2>
            <p class="text-xl lg:text-2xl text-white/90 mb-12 leading-relaxed">
                Join our satisfied patients and start your transformative wellness journey today.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('contact') }}" class="bg-white text-slate-700 px-10 py-5 rounded-full font-semibold text-lg hover:bg-white/90 transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center group">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Schedule Consultation
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ route('services') }}" class="border-2 border-white text-white px-10 py-5 rounded-full font-semibold text-lg hover:bg-white hover:text-slate-700 transition-all duration-300 transform hover:scale-105 flex items-center group">
                    <i class="fas fa-th-large mr-3"></i>
                    View Our Services
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
