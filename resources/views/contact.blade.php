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
<x-interactive-map
    :additional-cards="[
        [
            'icon' => 'fas fa-car text-cyan-600 text-3xl mb-3',
            'title' => 'Free Parking',
            'content' => 'Convenient parking available'
        ],
        [
            'icon' => 'fas fa-wheelchair text-cyan-600 text-3xl mb-3',
            'title' => 'Accessible',
            'content' => 'Wheelchair accessible entrance'
        ],
        [
            'icon' => 'fas fa-clock text-cyan-600 text-3xl mb-3',
            'title' => 'Flexible Hours',
            'content' => 'Open Monday-Friday'
        ]
    ]"
/>

<!-- Contact Form & Information -->
<section class="py-10 bg-white" data-aos="fade-up" id="main-content">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            <!-- Enhanced Contact Form -->
            <div>
                <x-contact-form
                    :action="route('contact.send')"
                    method="POST"
                />
            </div>

            <!-- Simplified Contact Information -->
            <div>
                <div class="space-y-6">
                    <!-- Main Contact Card -->
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
                                'label' => 'View Services',
                                'url' => route('services'),
                                'icon' => 'fas fa-th-large',
                                'variant' => 'secondary'
                            ]
                        ]"
                    />
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
