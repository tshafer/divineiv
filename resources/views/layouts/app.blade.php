<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Divine IV and Wellness - Chandler, AZ Med Spa')</title>
    <meta name="description" content="@yield('description', 'Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout, specializing in IV therapy, hormone replacement therapy, and aesthetic treatments.')">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .service-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Divine IV & Wellness</h1>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">Home</a>
                    <a href="{{ route('services') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">Services</a>
                    <a href="{{ route('blog') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">Blog</a>
                    <a href="{{ route('reviews') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">Reviews</a>
                    <a href="{{ route('page', 'about-us') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">About</a>
                    <a href="{{ route('page', 'contact-us') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">Contact</a>
                </div>
                <div class="md:hidden">
                    <button class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars"></i>
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
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Information</h3>
                    <p class="mb-2">3930 S Alma School Rd Suite 10</p>
                    <p class="mb-2">Chandler, AZ 85248</p>
                    <p class="mb-2">Phone: <a href="tel:480-488-9858" class="hover:text-blue-300">480-488-9858</a></p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-300">Home</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-blue-300">Services</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-blue-300">Blog</a></li>
                        <li><a href="{{ route('reviews') }}" class="hover:text-blue-300">Reviews</a></li>
                        <li><a href="{{ route('page', 'about-us') }}" class="hover:text-blue-300">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/divineivandwellness" class="text-2xl hover:text-blue-300">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/divineivandwellness/" class="text-2xl hover:text-blue-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://g.page/divineiv?share" class="text-2xl hover:text-blue-300">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; {{ date('Y') }} Divine IV and Wellness. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
