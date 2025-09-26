@props([
    'address' => '3930 S Alma School Rd Suite 10<br>Chandler, AZ 85248',
    'phone' => '(480) 488-9858',
    'email' => 'info@divineiv.com',
    'hours' => [
        'Mon, Wed-Fri: 9 AM - 5 PM',
        'Tuesday: Closed',
        'Lunch: 12-1:30 PM (except Tue)'
    ],
    'title' => 'Contact Information',
    'showTitle' => true
])

<div class="modern-card">
    @if($showTitle)
        <h3 class="heading-font text-2xl font-bold text-slate-800 mb-6">{{ $title }}</h3>
    @endif

    <!-- Address -->
    <div class="flex items-start mb-6">
        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-map-marker-alt text-white"></i>
        </div>
        <div class="ml-4">
            <h4 class="font-semibold text-gray-800">Address</h4>
            <p class="text-gray-600">{!! $address !!}</p>
        </div>
    </div>

    <!-- Phone -->
    <div class="flex items-start mb-6">
        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-phone text-white"></i>
        </div>
        <div class="ml-4">
            <h4 class="font-semibold text-gray-800">Phone</h4>
            <a href="tel:{!! str_replace(['(', ')', ' ', '-'], '', $phone) !!}" class="text-cyan-600 hover:text-cyan-700 transition-colors text-lg font-medium">
                {{ $phone }}
            </a>
        </div>
    </div>

    <!-- Email -->
    <div class="flex items-start mb-6">
        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-envelope text-white"></i>
        </div>
        <div class="ml-4">
            <h4 class="font-semibold text-gray-800">Email</h4>
            <a href="mailto:{{ $email }}" class="text-cyan-600 hover:text-cyan-700 transition-colors">
                {{ $email }}
            </a>
        </div>
    </div>

    <!-- Hours -->
    @if($hours)
    <div class="flex items-start">
        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-clock text-white"></i>
        </div>
        <div class="ml-4">
            <h4 class="font-semibold text-gray-800">Hours</h4>
            <div class="text-gray-600 text-sm">
                @foreach($hours as $hour)
                    <div @class(['text-amber-600 mt-1' => str_contains($hour, 'Lunch:')])>{{ $hour }}</div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
