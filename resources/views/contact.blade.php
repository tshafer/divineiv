@extends('layouts.app')

@section('title', 'Contact Us - Divine IV and Wellness | Chandler, AZ Med Spa')

@section('description', 'Contact Divine IV and Wellness in Chandler, AZ. Schedule your consultation today and start your wellness journey with our expert medical spa team.')

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
<!-- Enhanced Contact Map -->
<script>
    let map;

    function initMap() {
        const chandlerLocation = { lat: 33.2488454, lng: -111.8658575 };

        map = new google.maps.Map(document.getElementById("contact-map"), {
            zoom: 16,
            center: chandlerLocation,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [{ visibility: "off" }]
                }
            ]
        });

        // Custom marker design matching brand colors
        const markerIcon = {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 20,
            fillColor: "#0891b2",
            fillOpacity: 1,
            strokeColor: "#1e293b",
            strokeWeight: 3
        };

        const marker = new google.maps.Marker({
            position: chandlerLocation,
            map: map,
            icon: markerIcon,
            title: "Divine IV & Wellness - Chandler, AZ"
        });

        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="padding: 16px; max-width: 300px; font-family: 'Inter', sans-serif;">
                    <h3 style="color: #1e293b; margin: 0 0 12px 0; font-weight: bold; font-size: 18px;">Divine IV & Wellness</h3>
                    <div style="color: #64748b; font-size: 14px;">
                        <div style="margin: 6px 0;"><strong>📍</strong> 3930 S Alma School Rd Suite 10<br>Chandler, AZ 85248</div>
                        <div style="margin: 6px 0;"><strong>📞</strong> (480) 488-9858</div>
                        <div style="margin: 6px 0;"><strong>🕒</strong> Mon/Fri 9 AM - 5 PM</div>
                        <div style="margin: 6px 0;"><em>Wellness & Med Spa Specialist</em></div>
                    </div>
                </div>
            `
        });

        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });

        infoWindow.open(map, marker);
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>

<!-- Enhanced Hero Section -->
<x-hero
    title='Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-cyan-100">Divine IV & Wellness</span>'
    subtitle=""
    description="Ready to start your wellness journey? Contact our professional team to schedule your consultation and discover how we can help you achieve your health and beauty goals."
    class="hero-section"
    :highlights="[
        'badge_text' => 'Connect With Us',
        'cards' => [
            [
                'icon' => 'fas fa-phone text-cyan-300 text-2xl mb-3',
                'title' => 'Call Us',
                'content' => '(480) 488-9858'
            ],
            [
                'icon' => 'fas fa-envelope text-cyan-300 text-2xl mb-3',
                'title' => 'Email Us',
                'content' => 'info@divineiv.com'
            ],
            [
                'icon' => 'fas fa-map-marker-alt text-cyan-300 text-2xl mb-3',
                'title' => 'Visit Us',
                'content' => 'Chandler, AZ'
            ]
        ]
    ]"
/>

<!-- Interactive Map Section -->
<section class="py-16 bg-gradient-to-b from-slate-50 to-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up" data-aos-delay="200">
            <h2 class="heading-font text-4xl font-bold text-slate-800 mb-4 animate-fade-in-up">Find Our Chandler Location</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Located in the heart of Chandler, Arizona, we're easy to find and conveniently accessible
                for your wellness appointments.
            </p>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-cyan-100 contact-page-map
                    hover:shadow-2xl transform transition-all duration-500 hover:scale-105"
             data-aos="zoom-in" data-aos-delay="400">
            <div id="contact-map" class="w-full h-96"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-lg contact-card-hover animate-fade-in-up"
                 data-aos="fade-up" data-aos-delay="600">
                <div class="inline-block">
                    <i class="fas fa-car text-cyan-600 text-3xl mb-3 animate-bounce" style="animation-delay: 0s;"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Free Parking</h3>
                <p class="text-gray-600 text-sm">Convenient parking available</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-lg contact-card-hover animate-fade-in-up"
                 data-aos="fade-up" data-aos-delay="700">
                <div class="inline-block">
                    <i class="fas fa-wheelchair text-cyan-600 text-3xl mb-3 animate-bounce" style="animation-delay: 0.3s;"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Accessible</h3>
                <p class="text-gray-600 text-sm">Wheelchair accessible entrance</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-lg contact-card-hover animate-fade-in-up"
                 data-aos="fade-up" data-aos-delay="800">
                <div class="inline-block">
                    <i class="fas fa-clock text-cyan-600 text-3xl mb-3 animate-bounce" style="animation-delay: 0.6s;"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Flexible Hours</h3>
                <p class="text-gray-600 text-sm">Open Monday-Friday</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Information -->
<section class="py-20 bg-white" data-aos="fade-up" id="main-content">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            <!-- Enhanced Contact Form -->
            <div>
                <div class="modern-card">
                    <div class="mb-8">
                        <h2 class="heading-font text-3xl font-bold text-slate-800 mb-4">Send Us a Message</h2>
                        <p class="text-gray-600 mb-6">Tell us about your wellness goals and we'll get back to you quickly.</p>

                        <!-- Form Progress Indicator -->
                        <div class="flex items-center space-x-2 mb-6">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-cyan-600 text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <span class="ml-2 text-sm font-medium text-gray-700">Fill Form</span>
                            </div>
                            <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <span class="ml-2 text-sm font-medium text-gray-500">We Review</span>
                            </div>
                            <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <span class="ml-2 text-sm font-medium text-gray-500">We Contact You</span>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    placeholder="Your full name"
                                    required
                                >
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    placeholder="your.email@example.com"
                                    required
                                >
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                    placeholder="(480) 555-0123"
                                >
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="patient_status" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Patient Status
                                </label>
                                <select
                                    id="patient_status"
                                    name="patient_status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                >
                                    <option value="">Select status...</option>
                                    <option value="new" {{ old('patient_status') == 'new' ? 'selected' : '' }}>New Patient</option>
                                    <option value="existing" {{ old('patient_status') == 'existing' ? 'selected' : '' }}>Existing Patient</option>
                                    <option value="other" {{ old('patient_status') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('patient_status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Subject
                            </label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Consultation, Service Inquiry, etc."
                            >
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Tell us about your wellness goals and how we can help you..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold py-4 px-8 rounded-lg hover:from-cyan-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center group"
                            >
                                <i class="fas fa-paper-plane mr-3"></i>
                                Send Message
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Enhanced Contact Information -->
            <div>
                <div class="space-y-8">
                    <!-- Contact Card -->
                    <div class="modern-card">
                        <h3 class="heading-font text-2xl font-bold text-slate-800 mb-6">Get In Touch</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-800 text-lg">Address</h4>
                                    <p class="text-gray-600">3930 S Alma School Rd Suite 10<br>Chandler, AZ 85248</p>
                                    <a href="https://maps.google.com/maps?q=3930+S+Alma+School+Rd+Suite+10+Chandler+AZ+85248"
                                       target="_blank"
                                       class="text-cyan-600 hover:text-cyan-700 text-sm font-medium transition-colors mt-1 inline-block">
                                        <i class="fas fa-external-link-alt mr-1"></i>Get Directions
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-phone text-white text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-800 text-lg">Phone</h4>
                                    <a href="tel:480-488-9858" class="text-cyan-600 hover:text-cyan-700 transition-colors text-lg font-medium">
                                        (480) 488-9858
                                    </a>
                                    <p class="text-gray-500 text-sm mt-1">Available during business hours</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-envelope text-white text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-800 text-lg">Email</h4>
                                    <a href="mailto:info@divineiv.com" class="text-cyan-600 hover:text-cyan-700 transition-colors">
                                        info@divineiv.com
                                    </a>
                                    <p class="text-gray-500 text-sm mt-1">We respond within 24 hours</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Hours Card -->
                    <div class="modern-card">
                        <h3 class="heading-font text-2xl font-bold text-slate-800 mb-6">Office Hours</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-800">Monday</span>
                                </div>
                                <span class="text-gray-600">9:00 AM - 5:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-800">Tuesday</span>
                                </div>
                                <span class="text-gray-600">Closed</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-800">Wednesday</span>
                                </div>
                                <span class="text-gray-600">9:00 AM - 5:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-800">Thursday</span>
                                </div>
                                <span class="text-gray-600">9:00 AM - 5:00 PM</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                    <span class="font-medium text-gray-800">Friday</span>
                                </div>
                                <span class="text-gray-600">9:00 AM - 5:00 PM</span>
                            </div>
                        </div>
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mt-6">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-amber-600 mr-2"></i>
                                <span class="text-sm text-amber-800 font-medium">Lunch Break Notice</span>
                            </div>
                            <p class="text-sm text-amber-700 mt-2">
                                Closed daily for lunch 12:00 PM - 1:30 PM (except Tuesday)
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="modern-card">
                        <h3 class="heading-font text-2xl font-bold text-slate-800 mb-6">Quick Actions</h3>
                        <div class="space-y-4">
                            <a href="tel:480-488-9858" class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold py-4 px-6 rounded-lg text-center hover:from-cyan-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 flex items-center justify-center group">
                                <i class="fas fa-phone mr-3"></i>
                                Call Now
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="{{ route('services') }}" class="w-full border-2 border-cyan-600 text-cyan-600 font-semibold py-4 px-6 rounded-lg text-center hover:bg-cyan-600 hover:text-white transform hover:scale-105 transition-all duration-300 flex items-center justify-center group">
                                <i class="fas fa-th-large mr-3"></i>
                                View Services
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="mailto:info@divineiv.com" class="w-full border-2 border-gray-300 text-gray-700 font-semibold py-4 px-6 rounded-lg text-center hover:bg-gray-100 hover:border-gray-400 transition-all duration-300 flex items-center justify-center group">
                                <i class="fas fa-envelope mr-3"></i>
                                Send Email
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="modern-card">
                        <h3 class="heading-font text-2xl font-bold text-slate-800 mb-6">What to Expect</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-clock text-cyan-600 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Response Time</h4>
                                    <p class="text-gray-600 text-sm">We'll contact you within 24 hours</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-shield-alt text-cyan-600 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Privacy</h4>
                                    <p class="text-gray-600 text-sm">Your information is secure and private</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-user-md text-cyan-600 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Consultation</h4>
                                    <p class="text-gray-600 text-sm">Free initial consultation available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
