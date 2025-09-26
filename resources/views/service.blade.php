@extends('layouts.app')

@section('title', $service->title . ' - Divine IV and Wellness | Chandler, AZ')

@section('description', $service->description)

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
    :title="$service->title"
    :description="$service->description"
    :highlights="[
        'badge_text' => 'Professional Treatment',
        'cards' => [
            [
                'icon' => 'fas fa-calendar-check text-cyan-300 text-2xl mb-3',
                'title' => 'Schedule Treatment',
                'content' => 'Book your personalized consultation'
            ],
            [
                'icon' => 'fas fa-user-md text-cyan-300 text-2xl mb-3',
                'title' => 'Expert Care',
                'content' => 'Professional medical spa team'
            ],
            [
                'icon' => 'fas fa-clock text-cyan-300 text-2xl mb-3',
                'title' => 'Quick Results',
                'content' => 'See improvement quickly'
            ]
        ]
    ]"
/>

<!-- Service Details Section -->
<section class="py-10 bg-white" data-aos="fade-up" id="main-content">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            <!-- Main Content -->
            <div class="prose prose-lg max-w-none">
                <h2 class="heading-font text-3xl font-bold text-slate-800 mb-6" data-aos="fade-up" data-aos-delay="200">About {{ $service->title }}</h2>
                <div class="text-gray-600 leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                    {!! nl2br(e($service->content)) !!}
                </div>
            </div>

            <!-- Quick Actions Sidebar -->
            <div class="space-y-6">
                <!-- Contact Information Card -->
                <x-contact-info
                    :hours="[
                        'Mon, Wed-Fri: 9 AM - 5 PM',
                        'Tuesday: Closed',
                        'Lunch: 12-1:30 PM (except Tue)'
                    ]"
                />

                <!-- Quick Actions -->
                <x-quick-actions
                    :actions="[
                        [
                            'label' => 'Call Now',
                            'url' => 'tel:480-488-9858',
                            'icon' => 'fas fa-phone',
                            'variant' => 'primary'
                        ],
                        [
                            'label' => 'Schedule {{ $service->title }}',
                            'url' => route('page', 'contact-us'),
                            'icon' => 'fas fa-calendar',
                            'variant' => 'primary'
                        ],
                        [
                            'label' => 'View All Services',
                            'url' => route('services'),
                            'icon' => 'fas fa-th-large',
                            'variant' => 'secondary'
                        ]
                    ]"
                />
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Call to Action -->
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
                    <span class="text-cyan-200 font-semibold">Interested in {{ $service->title }}?</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-6xl font-bold mb-6" data-aos="fade-up" data-aos-delay="300">
                Ready for Your
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">{{ $service->title }}</span>
                Treatment?
            </h2>
            <p class="text-xl lg:text-2xl text-blue-100 mb-12 leading-relaxed" data-aos="fade-up" data-aos-delay="500">
                Contact us today to learn more about this service and schedule your personalized consultation.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center" data-aos="fade-up" data-aos-delay="700">
                <a href="{{ route('page', 'contact-us') }}" class="bg-white text-blue-600 px-10 py-5 rounded-full font-semibold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center group">
                    <i class="fas fa-calendar-check mr-3"></i>
                    Schedule Consultation
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="tel:480-488-9858" class="border-2 border-white text-white px-10 py-5 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 flex items-center group">
                    <i class="fas fa-phone mr-3"></i>
                    Call: (480) 488-9858
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
