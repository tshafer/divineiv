@extends('layouts.app')

@section('title', $service->title . ' - Divine IV and Wellness | Chandler, AZ')

@section('description', $service->description)

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ $service->title }}</h1>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $service->description }}</p>
    </div>
</section>

<!-- Service Details -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="prose prose-lg max-w-none">
            <div class="bg-gray-50 rounded-lg p-8 mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">About {{ $service->title }}</h2>
                <p class="text-lg text-gray-600 leading-relaxed">{{ $service->content }}</p>
            </div>

            @if($service->content && $service->content !== $service->description)
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">What to Expect</h3>
                <div class="text-gray-600 leading-relaxed">
                    {!! nl2br(e($service->content)) !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Interested in {{ $service->title }}?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Contact us today to learn more about this service and schedule your consultation.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('page', 'contact-us') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                Schedule Consultation
            </a>
            <a href="{{ route('services') }}" class="border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-purple-600 hover:text-white transition duration-300">
                View All Services
            </a>
        </div>
    </div>
</section>
@endsection
