@extends('layouts.app')

@section('title', 'Divine IV and Wellness - Chandler, AZ Med Spa | Your Expression of Natural Beauty')

@section('description', 'Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout, specializing in IV therapy, hormone replacement therapy, weight loss, and aesthetic treatments.')

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
    title='Med Spa <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Chandler, AZ</span>'
    :description="'Welcome to Divine IV and Wellness. Led by Family Nurse Practitioner Amy Berkhout, our practice specializes in IV therapy, hormone replacement therapy, weight loss, and cutting-edge aesthetic treatments.'"
    :style="'min-height: 85vh;'"
    :highlights="[
        'badge_text' => 'Chandler Med Spa',
        'cards' => [
            [
                'icon' => 'fas fa-star text-cyan-300 text-2xl mb-3',
                'title' => 'Explore Services',
                'content' => 'Transformative wellness solutions'
            ],
            [
                'icon' => 'fas fa-calendar-check text-cyan-300 text-2xl mb-3',
                'title' => 'Schedule Today',
                'content' => 'Book your consultation'
            ],
            [
                'icon' => 'fas fa-user-md text-cyan-300 text-2xl mb-3',
                'title' => 'Expert Care',
                'content' => 'Professional Amy Berkhout, FNP'
            ]
        ]
    ]"
/>

<!-- Services Section -->
<section class="py-20 bg-gradient-to-b from-slate-50 to-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-cyan-50 rounded-full px-6 py-3">
                    <i class="fas fa-medical-kit text-cyan-600 mr-3 text-lg"></i>
                    <span class="text-cyan-600 font-semibold">Featured Services</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-5xl font-bold text-slate-800 mb-6">
                Transformative
                <span class="text-gradient">Wellness Solutions</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Experience our comprehensive suite of medical spa services designed to enhance your natural beauty
                and promote optimal wellness through cutting-edge treatments.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16" data-aos="fade-up" data-aos-delay="400">
            @foreach($services as $index => $service)
            <div class="modern-card text-center group" data-aos="fade-up" data-aos-delay="{{ 600 + ($index * 100) }}">
                <div class="mb-6">
                    @if($service->icon)
                        <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="{{ $service->icon }} text-white text-2xl"></i>
                        </div>
                    @else
                        <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-heart text-white text-2xl"></i>
                        </div>
                    @endif
                    <h3 class="heading-font text-2xl font-semibold text-slate-800 mb-4">{{ $service->title }}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $service->description }}</p>
                </div>
                <a href="{{ route('service', $service->slug) }}" class="group-hover:text-cyan-600 text-cyan-500 font-semibold hover:text-cyan-700 transition-colors duration-300 flex items-center justify-center">
                    Discover More
                    <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center" data-aos="fade-up" data-aos-delay="800">
            <a href="{{ route('services') }}" class="inline-flex items-center bg-gradient-to-r from-cyan-600 to-cyan-700 text-white px-8 py-4 rounded-full font-semibold hover:from-cyan-700 hover:to-cyan-800 transition-all duration-300 transform hover:scale-105 shadow-lg group">
                <i class="fas fa-th-large mr-3"></i>
                Explore All Treatments
                <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<!-- About Section -->
@if($aboutPage)
<section class="py-20 hero-gradient text-white relative overflow-hidden" data-aos="fade-up">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-20 w-32 h-32 border border-white rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 border border-white rounded-full"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 border border-white rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center" data-aos="fade-up" data-aos-delay="300">
            <!-- Content -->
            <div class="space-y-8">
                <div class="flex items-center space-x-4 mb-6" data-aos="fade-in" data-aos-delay="400">
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-user-md text-2xl text-white"></i>
                    </div>
                    <div class="border-l-4 border-green-400 pl-4">
                        <h3 class="text-lg font-semibold text-green-100">Family Nurse Practitioner</h3>
                        <p class="text-white/90">FNP-BC Certified</p>
                    </div>
                </div>

                <h2 class="heading-font text-4xl lg:text-6xl font-bold mb-6" data-aos="fade-up" data-aos-delay="500">
                    Meet
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Amy Berkhout</span>
                </h2>

                <div class="space-y-6 text-lg leading-relaxed">
                    <p class="text-blue-100" data-aos="fade-up" data-aos-delay="600">
                        Amy Berkhout, FNP-BC is a family nurse practitioner with extensive expertise in
                        <span class="font-semibold text-white">hormone replacement therapy</span>,
                        aesthetics, and IV infusion therapy.
                    </p>
                    <p class="text-blue-100" data-aos="fade-up" data-aos-delay="700">
                        Our Chandler, AZ practice helps patients achieve their personal aesthetic and wellness goals
                        through personalized, evidence-based treatments.
                    </p>
                    <p class="text-blue-100" data-aos="fade-up" data-aos-delay="800">
                        With decades of nursing experience and health promotion expertise, Amy delivers the
                        <span class="font-semibold text-white">distinguished level of care</span>
                        you deserve in luxury medical spa setting.
                    </p>
                </div>

                <div class="pt-6" data-aos="fade-up" data-aos-delay="900">
                    <a href="{{ route('page', 'amy-berkhout') }}" class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-lg group inline-flex items-center">
                        <i class="fas fa-graduation-cap mr-3"></i>
                        Learn About Amy's Journey
                        <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="flex justify-center lg:justify-end" data-aos="fade-left" data-aos-delay="500">
                <div class="relative">
                    <!-- Professional Photo Placeholder -->
                    <div class="w-80 h-80 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl shadow-2xl flex items-center justify-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
                        <div class="text-center z-10">
                            <i class="fas fa-user-md text-white text-6xl mb-4 opacity-80"></i>
                            <div class="text-white text-lg font-semibold">Professional Photo</div>
                            <div class="text-blue-200 text-sm">Amy Berkhout, FNP-BC</div>
                        </div>

                        <!-- Decorative Elements -->
                        <div class="absolute top-6 right-6 w-8 h-8 border-2 border-yellow-300 rounded-full opacity-60"></div>
                        <div class="absolute bottom-6 left-6 w-6 h-6 border-2 border-green-300 rounded-full opacity-60"></div>
                    </div>

                    <!-- Floating Awards/Trust indicators -->
                    <div class="absolute -top-4 -left-4 bg-yellow-400 text-blue-900 px-4 py-2 rounded-full font-bold text-sm">
                        ⭐ 5.0 Rating
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-green-400 text-white px-4 py-2 rounded-full font-bold text-sm">
                        Certified FNP
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Reviews Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-yellow-100 rounded-full px-6 py-3">
                    <i class="fas fa-star text-yellow-500 mr-3"></i>
                    <span class="text-yellow-600 font-semibold">Client Testimonials</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-5xl font-bold text-gray-800 mb-6">
                What Our Clients Say
            </h2>
            <div class="flex justify-center items-center mb-8" data-aos="fade-up" data-aos-delay="400">
                <div class="flex text-yellow-400 text-3xl mr-6">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text-center">
                    <span class="text-3xl font-bold text-gray-800 heading-font block">5.0</span>
                    <span class="text-lg text-gray-600">Average Rating</span>
                </div>
            </div>
            <p class="text-xl text-gray-600">Join 177+ satisfied clients on their wellness journey</p>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16" data-aos="fade-up" data-aos-delay="600">
            @foreach($reviews as $index => $review)
            <div class="modern-card text-center group" data-aos="fade-up" data-aos-delay="{{ 800 + ($index * 200) }}">
                <!-- Stars -->
                <div class="flex justify-center text-yellow-400 mb-6">
                    @for($i = 0; $i < $review->rating; $i++)
                        <i class="fas fa-star text-xl"></i>
                    @endfor
                </div>

                <!-- Quote -->
                <blockquote class="text-gray-700 text-lg leading-relaxed mb-8 italic relative">
                    <i class="fas fa-quote-left text-blue-300 text-3xl mb-4 block"></i>
                    "{{ $review->content }}"
                </blockquote>

                <!-- Author Info -->
                <div class="border-t pt-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            {{ strtoupper(substr($review->author_name, 0, 1)) }}
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-gray-800 heading-font">{{ $review->author_name }}</div>
                            @if($review->source)
                                <div class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    {{ $review->source }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center" data-aos="fade-up" data-aos-delay="1000">
            <a href="{{ route('reviews') }}" class="inline-flex items-center bg-gradient-to-r from-cyan-600 to-cyan-700 text-white px-8 py-4 rounded-full font-semibold hover:from-cyan-700 hover:to-cyan-800 transition-all duration-300 transform hover:scale-105 shadow-lg group">
                <i class="fas fa-comments mr-3"></i>
                Read All Testimonials
                <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 hero-gradient text-white relative overflow-hidden" data-aos="fade-up">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-20 w-32 h-32 border border-white rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 border border-white rounded-full"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 border border-white rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-center mb-6">
                <div class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3 backdrop-blur-sm">
                    <div class="w-6 h-6 bg-cyan-300 rounded-full mr-3"></div>
                    <span class="text-cyan-200 font-semibold">Contact Our Team</span>
                </div>
            </div>
            <h2 class="heading-font text-4xl lg:text-6xl font-bold mb-6" data-aos="fade-up" data-aos-delay="300">
                Ready to Start Your
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Wellness Journey?</span>
            </h2>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="500">
                Get in touch with our Chandler office to schedule your personalized consultation
                and discover how we can help you achieve your wellness goals.
            </p>
        </div>

        <!-- Contact Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16" data-aos="fade-up" data-aos-delay="700">
            <div class="modern-card bg-white bg-opacity-10 text-center group backdrop-blur-sm">
                <div class="w-20 h-20 bg-yellow-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-map-marker-alt text-blue-900 text-2xl"></i>
                </div>
                <h3 class="heading-font text-2xl font-bold mb-4">Visit Our Clinic</h3>
                <div class="space-y-2 text-blue-100">
                    <p class="font-semibold">3930 S Alma School Rd Suite 10</p>
                    <p>Chandler, AZ 85248</p>
                </div>
            </div>

            <div class="modern-card bg-white bg-opacity-10 text-center group backdrop-blur-sm">
                <div class="w-20 h-20 bg-green-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-phone text-white text-2xl"></i>
                </div>
                <h3 class="heading-font text-2xl font-bold mb-4">Call Us Today</h3>
                <a href="tel:480-488-9858" class="text-blue-100 hover:text-white transition-colors duration-300 font-semibold text-xl">
                    480-488-9858
                </a>
            </div>

            <div class="modern-card bg-white bg-opacity-10 text-center group backdrop-blur-sm">
                <div class="w-20 h-20 bg-blue-400 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <h3 class="heading-font text-2xl font-bold mb-4">Book Appointment</h3>
                <a href="{{ route('contact') }}" class="text-blue-100 hover:text-white transition-colors duration-300 font-semibold">
                    Schedule Your Consultation
                </a>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center" data-aos="fade-up" data-aos-delay="900">
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-10 py-5 rounded-full font-semibold text-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center group">
                    <i class="fas fa-envelope mr-3"></i>
                    Send Us a Message
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="tel:480-488-9858" class="border-2 border-white text-white px-10 py-5 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 flex items-center group">
                    <i class="fas fa-phone mr-3"></i>
                    Call Now: (480) 488-9858
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
