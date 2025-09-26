@extends('layouts.app')

@section('title', 'Med Spa Blog - Divine IV and Wellness | Chandler, AZ')

@section('description', 'Stay updated with the latest wellness and aesthetic treatment information from Divine IV and Wellness in Chandler, AZ. Expert insights on IV therapy, hormone replacement, and skin treatments.')

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
                    <i class="fas fa-newspaper text-cyan-300 mr-3"></i>
                    <span class="text-cyan-200 font-semibold">Latest Insights</span>
                </div>
            </div>
            <h1 class="heading-font text-5xl lg:text-7xl font-bold mb-6">
                Med Spa
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Blog</span>
            </h1>
            <p class="text-xl lg:text-2xl mb-12 max-w-3xl mx-auto text-white/90 leading-relaxed">
                Stay informed with the latest insights on wellness, aesthetics, and treatments
                from our expert medical team at Divine IV & Wellness.
            </p>
        </div>
    </div>
</section>

<!-- Blog Posts -->
<section class="py-20 bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($posts as $post)
            <article class="modern-card overflow-hidden group">
                <!-- Image -->
                @if($post->featured_image)
                <div class="h-48 bg-gray-200 relative overflow-hidden rounded-t-2xl">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                @else
                <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center relative overflow-hidden rounded-t-2xl">
                    <i class="fas fa-newspaper text-white text-6xl opacity-80"></i>
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/50 to-blue-700/50"></div>
                </div>
                @endif

                <!-- Content -->
                <div class="p-8">
                    <div class="flex items-center text-blue-600 text-sm font-semibold mb-4">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        {{ $post->created_at->format('F j, Y') }}
                    </div>
                    <h2 class="heading-font text-2xl font-semibold text-gray-800 mb-4 line-clamp-2 group-hover:text-blue-600 transition-colors">
                        {{ $post->title }}
                    </h2>
                    @if($post->excerpt)
                    <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                    @endif
                    <a href="{{ route('page', $post->slug) }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors group">
                        Read Article
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 medical-gradient text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-40 h-40 border border-white rounded-full"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 border border-white rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3">
                    <i class="fas fa-star text-blue-200 mr-3"></i>
                    <span class="text-blue-200 font-semibold">Ready to Begin?</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-6xl font-bold mb-6">
                Ready to Experience Our
                <span class="text-yellow-300">Treatments?</span>
            </h2>
            <p class="text-xl lg:text-2xl text-blue-100 mb-12 leading-relaxed">
                Contact us today to schedule your personalized consultation and begin your
                transformative wellness journey with our expert team.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('page', 'contact-us') }}" class="bg-white text-blue-600 px-10 py-5 rounded-full font-semibold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center group">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Schedule Consultation
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ route('services') }}" class="border-2 border-white text-white px-10 py-5 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 flex items-center group">
                    <i class="fas fa-th-large mr-3"></i>
                    View Our Services
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
