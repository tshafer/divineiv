@props([
    'icon' => 'fas fa-star',
    'title' => 'Sample Title',
    'content' => 'Sample content',
    'iconClass' => 'text-cyan-600',
    'titleClass' => 'font-semibold text-gray-800',
    'contentClass' => 'text-gray-600 text-sm',
    'cardClass' => 'text-center p-6 bg-white rounded-lg shadow-lg contact-card-hover animate-fade-in-up',
    'aos' => '',
    'delay' => 0
])

<div
    @class([
        $cardClass,
        'animate-fade-in-up' => !$aos
    ])
    @if($aos)
    data-aos="{{ $aos }}"
    data-aos-delay="{{ $delay }}"
    @endif
>
    @if($icon)
    <div class="inline-block">
        <i class="{{ $icon }} {{ $iconClass }} text-3xl mb-3"></i>
    </div>
    @endif

    @if($title)
    <h3 class="{{ $titleClass }} mb-2">{!! $title !!}</h3>
    @endif

    @if($content)
    <p class="{{ $contentClass }}">{!! $content !!}</p>
    @endif

    @if($slot->hasActualContent())
        {{ $slot }}
    @endif
</div>
