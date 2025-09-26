@props([
    'type' => 'success', // success, error, warning, info
    'title' => '',
    'message' => '',
    'dismissible' => true,
    'showIcon' => true
])

@php
    $classes = match($type) {
        'success' => 'bg-green-50 border-green-200 text-green-600',
        'error' => 'bg-red-50 border-red-200 text-red-600',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-600',
        'info' => 'bg-blue-50 border-blue-200 text-blue-600',
        default => 'bg-gray-50 border-gray-200 text-gray-600'
    };

    $icons = match($type) {
        'success' => 'fas fa-check-circle',
        'error' => 'fas fa-exclamation-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'info' => 'fas fa-info-circle',
        default => 'fas fa-info-circle'
    };
@endphp

<div
    class="{{ $classes }} border px-4 py-3 rounded-lg mb-6 {{ $dismissible ? 'flex items-center justify-between' : '' }}"
    x-data="{ show: true }"
    x-show="show"
    x-transition
>
    <div class="flex items-center">
        @if($showIcon)
            <i class="{{ $icons }} mr-2"></i>
        @endif
        <div>
            @if($title)
                <div class="font-semibold">{{ $title }}</div>
            @endif
            <div>{{ $message ?: $slot }}</div>
        </div>
    </div>

    @if($dismissible)
        <button
            class="ml-4 text-current/70 hover:text-current/100 transition-colors"
            @click="show = false"
        >
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
