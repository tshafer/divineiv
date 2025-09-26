@extends('layouts.app')

@section('title', 'Med Spa Blog - Divine IV and Wellness | Chandler, AZ')

@section('description', 'Stay updated with the latest wellness and aesthetic treatment information from Divine IV and Wellness in Chandler, AZ. Expert insights on IV therapy, hormone replacement, and skin treatments.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Med Spa Blog</h1>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Stay informed with the latest insights on wellness, aesthetics, and treatments from our expert team.
        </p>
    </div>
</section>

<!-- Blog Posts -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-gray-50 rounded-lg shadow-md overflow-hidden">
                @if($post->featured_image)
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
                @else
                <div class="h-48 bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-newspaper text-purple-600 text-4xl"></i>
                </div>
                @endif

                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">
                        {{ $post->created_at->format('F j, Y') }}
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2">
                        {{ $post->title }}
                    </h2>
                    @if($post->excerpt)
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $post->excerpt }}
                    </p>
                    @endif
                    <a href="{{ route('page', $post->slug) }}" class="text-purple-600 font-semibold hover:text-purple-800 transition duration-300">
                        Read More <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Experience Our Treatments?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Contact us today to schedule your consultation and begin your wellness journey.
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
