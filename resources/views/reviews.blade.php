@extends('layouts.app')

@section('title', 'Reviews - Divine IV and Wellness | Chandler, AZ Med Spa')

@section('description', 'Read what our patients say about Divine IV and Wellness in Chandler, AZ. Real reviews from satisfied patients who have experienced our IV therapy, aesthetic treatments, and wellness services.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Patient Reviews</h1>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            See what our patients are saying about their experience at Divine IV and Wellness.
        </p>
        <div class="flex justify-center items-center">
            <div class="flex text-yellow-400 text-3xl mr-4">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <span class="text-3xl font-bold">5.0</span>
            <span class="text-xl ml-2">Average Rating</span>
        </div>
    </div>
</section>

<!-- Reviews Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($reviews as $review)
            <div class="bg-gray-50 rounded-lg p-6 shadow-md">
                <div class="flex text-yellow-400 mb-4">
                    @for($i = 0; $i < $review->rating; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p class="text-gray-600 mb-6 italic leading-relaxed">"{{ $review->content }}"</p>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="font-semibold text-gray-800">{{ $review->author_name }}</span>
                        @if($review->source)
                            <span class="text-sm text-gray-500 block">{{ $review->source }}</span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $review->created_at->format('M j, Y') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Experience Our Care?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Join our satisfied patients and start your wellness journey today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('page', 'contact-us') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                Schedule Consultation
            </a>
            <a href="{{ route('services') }}" class="border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                View Our Services
            </a>
        </div>
    </div>
</section>
@endsection
