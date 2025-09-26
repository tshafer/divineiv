<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Divine IV and Wellness - Chandler, AZ Med Spa')</title>
    <meta name="description" content="@yield('description', 'Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout, specializing in IV therapy, hormone replacement therapy, and aesthetic treatments.')">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Divine IV & Wellness Brand Colors - Enhanced Blues Closer to Logo */
        :root {
            /* Logo colors for accent use */
            --brand-magenta: #c34298;
            --brand-cyan: #05abdb;

            /* Professional navy base */
            --primary-navy: #1e293b;
            --primary-navy-light: #334155;
            --primary-navy-dark: #0f172a;

            /* Enhanced blues inspired by logo cyan */
            --primary-blue: #2563eb;
            --primary-blue-light: #3b82f6;
            --primary-blue-dark: #1d4ed8;
            --bright-cyan: #0891b2;
            --bright-cyan-light: #06b6d4;
            --bright-cyan-dark: #0e7490;

            /* Logo cyan for strategic highlights */
            --logo-cyan: #05abdb;
            --logo-cyan-soft: rgba(5, 171, 219, 0.1);
            --logo-cyan-medium: rgba(5, 171, 219, 0.6);

            /* Warm neutral backgrounds */
            --background-cream: #fefdf8;
            --background-soft: #fafaf9;
            --background-blue-tinted: #f8fafc;
            --background-light-blue: #f0f7ff;

            /* Professional text colors */
            --text-dark: #111827;
            --text-medium: #64748b;
            --text-light: #94a3b8;
            --text-navy: #1e293b;

            /* Enhanced blue gradients */
            --brand-gradient: linear-gradient(135deg, var(--primary-blue-dark) 0%, var(--bright-cyan) 50%, var(--bright-cyan-light) 100%);
            --navy-blue-gradient: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue-light) 100%);
            --cyan-gradient: linear-gradient(135deg, var(--bright-cyan-dark) 0%, var(--logo-cyan) 100%);
            --hero-gradient: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 50%, var(--bright-cyan) 100%);
            --brand-gradient-subtle: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(5, 171, 219, 0.05) 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .brand-gradient {
            background: var(--brand-gradient);
        }

        .hero-gradient {
            background: var(--hero-gradient);
        }

        .navy-blue-gradient {
            background: var(--navy-blue-gradient);
        }

        .cyan-gradient {
            background: var(--cyan-gradient);
        }

        .brand-gradient-subtle {
            background: var(--brand-gradient-subtle);
        }

        .soft-gradient {
            background: linear-gradient(135deg, var(--background-cream) 0%, var(--background-blue-tinted) 100%);
        }

        .logo-cyan-highlight {
            color: var(--logo-cyan);
        }

        .logo-cyan-bg-soft {
            background: var(--logo-cyan-soft);
        }

        .logo-cyan-bg-medium {
            background: var(--logo-cyan-medium);
        }

        /* Logo accent colors for special highlighting only */
        .magenta-accent {
            color: var(--brand-magenta);
        }

        .bstum-blue {
            color: var(--primary-blue);
        }

        /* Enhanced CSS Animations for Hero & Components */
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float-in-up {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            50% {
                transform: translateY(-5px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes card-float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-8px) rotate(180deg);
            }
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Hero Component Animations */
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-text {
            animation: fade-in-up 1s ease-out forwards;
        }

        .animate-title {
            animation: float-in-up 1.2s ease-out forwards;
        }

        .animate-subtitle {
            animation: fade-in-up 1.4s ease-out forwards;
        }

        .animate-buttons {
            animation: fade-in-up 1.6s ease-out forwards;
        }

        .animate-cards {
            animation: fade-in-up 1.8s ease-out forwards;
        }

        .animate-card-float {
            animation: card-float 2s ease-in-out;
        }

        /* Enhanced hover effects */
        .hero-section .backdrop-blur-sm {
            backdrop-filter: blur(8px);
        }

        .hero-section .absolute .border {
            animation: float 6s ease-in-out infinite;
        }

        /* Gradient shine animation */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shine 3s infinite;
            pointer-events: none;
        }

        /* Contact Page Specific Animations */
        .contact-page-map {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .contact-page-map:hover {
            transform: translateY(-5px);
        }

        .contact-form-field {
            transition: all 0.3s ease;
        }

        .contact-form-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(8, 145, 178, 0.2);
        }

        .contact-card-hover {
            transition: all 0.3s ease;
        }

        .contact-card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        .service-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
        }

        .premium-shadow {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .nav-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-gradient {
            background: linear-gradient(135deg, #fefdfb 0%, #f1f5f9 100%);
        }

        .btn-primary {
            background: var(--brand-gradient);
            border: none;
            color: white;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            transform: scale(1);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--brand-magenta-dark) 0%, var(--brand-cyan-dark) 100%);
            transform: scale(1.05);
        }

        .btn-secondary {
            border: 2px solid var(--brand-magenta);
            color: var(--brand-magenta);
            background: transparent;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--brand-magenta);
            color: white;
        }

        .text-gradient {
            background: var(--brand-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-magenta {
            color: var(--brand-magenta);
        }

        .text-cyan {
            color: var(--brand-cyan);
        }

        .hero-section {
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--brand-gradient);
            opacity: 0.9;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .modern-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .modern-card:hover {
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="brand-gradient nav-shadow relative">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <!-- Enhanced Logo & Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <img src="/logo.svg" alt="Divine IV & Wellness Logo" class="h-16 mr-4 group-hover:scale-110 transition-transform duration-300">

                    </a>
                </div>
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('page', 'about-us') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Amy Berkhout
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('page', 'about-us') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        About
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('services') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Services
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('page', 'photos') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Photos
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('reviews') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Reviews
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Translate
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        VIP Rewards
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Resources
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
                        Contact
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
                <div class="lg:hidden">
                    <button class="text-white hover:text-blue-200 p-2 rounded-lg hover:bg-blue-500/20 transition-all duration-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Contact Information -->
                <div class="space-y-4">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-leaf text-green-400 text-2xl mr-3"></i>
                        <h3 class="text-2xl font-bold heading-font">Contact Information</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-300 mr-3 mt-1"></i>
                            <div>
                                <p class="font-medium">3930 S Alma School Rd Suite 10</p>
                                <p class="text-blue-100">Chandler, AZ 85248</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-300 mr-3"></i>
                            <a href="tel:480-488-9858" class="text-blue-100 hover:text-white transition-colors">480-488-9858</a>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-300 mr-3"></i>
                            <a href="mailto:info@divineiv.com" class="text-blue-100 hover:text-white transition-colors">info@divineiv.com</a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold heading-font mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-blue-100 hover:text-white transition-colors duration-300 flex items-center group">
                            <i class="fas fa-arrow-right text-blue-300 mr-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>Home
                        </a></li>
                        <li><a href="{{ route('services') }}" class="text-blue-100 hover:text-white transition-colors duration-300 flex items-center group">
                            <i class="fas fa-arrow-right text-blue-300 mr-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>Services
                        </a></li>
                        <li><a href="{{ route('blog') }}" class="text-blue-100 hover:text-white transition-colors duration-300 flex items-center group">
                            <i class="fas fa-arrow-right text-blue-300 mr-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>Blog
                        </a></li>
                        <li><a href="{{ route('reviews') }}" class="text-blue-100 hover:text-white transition-colors duration-300 flex items-center group">
                            <i class="fas fa-arrow-right text-blue-300 mr-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>Reviews
                        </a></li>
                        <li><a href="{{ route('page', 'about-us') }}" class="text-blue-100 hover:text-white transition-colors duration-300 flex items-center group">
                            <i class="fas fa-arrow-right text-blue-300 mr-2 text-sm transform group-hover:translate-x-1 transition-transform"></i>About Us
                        </a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold heading-font mb-6">Follow Us</h3>
                    <p class="text-blue-100 mb-6">Stay connected with our wellness journey</p>
                    <div class="flex space-x-6">
                        <a href="https://www.facebook.com/divineivandwellness" class="w-12 h-12 bg-blue-600 bg-opacity-30 rounded-full flex items-center justify-center hover:bg-opacity-50 transition-all duration-300 group">
                            <i class="fab fa-facebook text-xl group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="https://www.instagram.com/divineivandwellness/" class="w-12 h-12 bg-blue-600 bg-opacity-30 rounded-full flex items-center justify-center hover:bg-opacity-50 transition-all duration-300 group">
                            <i class="fab fa-instagram text-xl group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="https://g.page/divineiv?share" class="w-12 h-12 bg-blue-600 bg-opacity-30 rounded-full flex items-center justify-center hover:bg-opacity-50 transition-all duration-300 group">
                            <i class="fab fa-google text-xl group-hover:scale-110 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Border -->
            <div class="border-t border-blue-400/30 mt-12 pt-8">
                <div class="flex flex-col sm:flex-row justify-between items-center text-center">
                    <p class="text-blue-100">&copy; {{ date('Y') }} Divine IV and Wellness. All rights reserved.</p>
                    <p class="text-blue-200 text-sm mt-2 sm:mt-0">Serving Chandler, AZ with Excellence</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
