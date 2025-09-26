@props([
    'title' => 'Quick Actions',
    'actions' => [
        [
            'label' => 'Call Now',
            'url' => 'tel:480-488-9858',
            'icon' => 'fas fa-phone',
            'variant' => 'primary'
        ],
        [
            'label' => 'View Services',
            'url' => '/services',
            'icon' => 'fas fa-th-large',
            'variant' => 'secondary'
        ]
    ],
    'showTitle' => true
])

<div class="modern-card">
    @if($showTitle)
        <h3 class="heading-font text-xl font-bold text-slate-800 mb-4">{{ $title }}</h3>
    @endif

    <div class="space-y-3">
        @foreach($actions as $action)
            @php
                $classes = match($action['variant'] ?? 'primary') {
                    'primary' => 'w-full bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-center hover:from-cyan-700 hover:to-blue-700',
                    'secondary' => 'w-full border-2 border-cyan-600 text-cyan-600 font-semibold py-3 px-4 rounded-lg text-center hover:bg-cyan-600 hover:text-white',
                    default => 'w-full bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-center hover:from-cyan-700 hover:to-blue-700'
                };
            @endphp

            <a href="{{ $action['url'] }}"
               class="{{ $classes }} transform hover:scale-105 transition-all duration-300 flex items-center justify-center group">
                @if(isset($action['icon']))
                    <i class="{{ $action['icon'] }} mr-2"></i>
                @endif
                {{ $action['label'] }}
            </a>
        @endforeach

        {{ $slot }}
    </div>
</div>
