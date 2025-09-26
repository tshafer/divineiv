@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title . ' - Divine IV and Wellness | Chandler, AZ')

@section('description', $page->meta_description ?: $page->excerpt)

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $page->excerpt }}</p>
        @endif
    </div>
</section>

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

<!-- Call to Action -->
@if($page->slug !== 'contact-us')
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
