@props([
    'title' => 'Divine IV & Wellness',
    'subtitle' => '',
    'description' => '',
    'backgroundStyle' => 'hero-gradient',
    'showDecoration' => true,
    'highlights' => [],
    'sectionId' => ''
])

@php
    $heroId = $sectionId ?: 'hero-section';
@endphp

<!-- Enhanced Hero Section with Animations -->
<section
    id="{{ $heroId }}"
    class="{{ $backgroundStyle }} text-white py-20 lg:py-32 relative overflow-hidden"
    data-aos="fade-up"
    data-aos-duration="1000"
>
    <!-- Subtle Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 right-20 w-32 h-32 border border-white rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-24 h-24 border border-white rounded-full"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 border border-white rounded-full"></div>
        <!-- Floating elements -->
        <div class="absolute top-1/3 left-1/3 w-8 h-8 border border-cyan-300 rounded-full opacity-40"></div>
        <div class="absolute bottom-1/3 right-1/3 w-12 h-12 border border-cyan-300 rounded-full opacity-40"></div>
    </div>

    <!-- Subtle overlay gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 via-transparent to-cyan-600/10"></div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Badge/Icon Animation -->
            @if($showDecoration)
            <div class="flex justify-center mb-6 animate-fade-in-up">
                <div
                    class="flex items-center bg-white bg-opacity-20 rounded-full px-6 py-3 backdrop-blur-sm
                           transform hover:scale-105 transition-all duration-500
                           hover:bg-white/30 shadow-lg hover:shadow-xl"
                    data-aos="fade-in"
                    data-aos-delay="200"
                >
                    <div class="w-6 h-6 bg-cyan-300 rounded-full mr-3"></div>
                    @if(isset($highlights['badge_text']))
                        <span class="text-cyan-200 font-semibold">{{ $highlights['badge_text'] }}</span>
                    @else
                        <span class="text-cyan-200 font-semibold">Professional Wellness Care</span>
                    @endif
                </div>
            </div>
            @endif

            <!-- Main Title with Enhanced Animations -->
            <h1
                class="heading-font text-5xl lg:text-7xl font-bold mb-6
                       animate-title float-in-up"
                data-aos="fade-up"
                data-aos-delay="300"
            >
                {!! $title !!}
            </h1>

            @if($subtitle)
            <h2
                class="heading-font text-3xl lg:text-4xl mb-8 text-white/90
                       animate-subtitle"
                data-aos="fade-up"
                data-aos-delay="500"
            >
                {!! $subtitle !!}
            </h2>
            @endif

            @if($description)
            <p
                class="text-xl lg:text-2xl mb-12 max-w-3xl mx-auto text-white/90 leading-relaxed
                       animate-text fade-in-delay"
                data-aos="fade-up"
                data-aos-delay="700"
            >
                {!! $description !!}
            </p>
            @endif

            <!-- Action Buttons with Enhanced Animations -->
            @if(isset($highlights['buttons']) && count($highlights['buttons']) > 0)
            <div
                class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16
                       animate-buttons fade-in-up-delay"
                data-aos="fade-up"
                data-aos-delay="900"
            >
                @foreach($highlights['buttons'] as $index => $button)
                @php
                    $delay = $index * 100;
                @endphp
                <a
                    href="{{ $button['url'] }}"
                    class="transform hover:scale-105 transition-all duration-500 hover:translate-y-1
                           {{ $button['style'] ?? 'bg-white text-slate-700' }}
                           px-10 py-5 rounded-full font-semibold text-lg
                           shadow-lg hover:shadow-xl flex items-center group
                           animate-pulse-on-hover"
                    style="animation-delay: {{ $delay }}ms;"
                    data-aos="fade-up"
                    data-aos-delay="{{ 1000 + $index * 100 }}"
                >
                @if(isset($button['icon']))
                @php
                    $iconClass = 'text-white';
                    if (isset($button['style']) && str_contains($button['style'], 'bg-white')) {
                        $iconClass = 'text-slate-700';
                    }
                @endphp
                <i class="{{ $button['icon'] }} mr-3 {{ $iconClass }} group-hover:rotate-12 transition-transform duration-300"></i>
                @endif
                    {{ $button['text'] }}
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
                @endforeach
            </div>
            @endif

            <!-- Highlight Cards/Stats Animations -->
            @if(isset($highlights['cards']) && count($highlights['cards']) > 0)
            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 animate-cards slide-up"
                data-aos="fade-up"
                data-aos-delay="1200"
            >
                @foreach($highlights['cards'] as $index => $card)
                @php
                    $delay = ($index * 200) + 1000;
                @endphp
                <div
                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6
                           transform hover:scale-105 transition-all duration-500
                           hover:bg-white/20 hover:shadow-xl group animate-card-float"
                    style="animation-delay: {{ $delay }}ms;"
                    data-aos="fade-up"
                    data-aos-delay="{{ 1400 + $index * 200 }}"
                >
                    @if(isset($card['icon']))
                    <i class="{{ $card['icon'] }} text-cyan-300 text-2xl mb-3 group-hover:animate-bounce"></i>
                    @endif
                    @if(isset($card['title']))
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-cyan-200 transition-colors">{{ $card['title'] }}</h3>
                    @endif
                    @if(isset($card['content']))
                    <p class="text-cyan-100 group-hover:text-white transition-colors">{!! $card['content'] !!}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- Floating scroll indicator -->
    @if(isset($highlights['scroll_indicator']) && $highlights['scroll_indicator'])
    <div
        class="absolute bottom-8 left-1/2 transform -translate-x-1/2
               animate-bounce cursor-pointer"
        data-aos="fade-in"
        data-aos-delay="1500"
        onclick="document.getElementById('main-content').scrollIntoView({behavior: 'smooth'})"
    >
        <i class="fas fa-chevron-down text-cyan-300 text-xl hover:text-white transition-colors"></i>
    </div>
    @endif
</section>

{{-- Enhanced CSS Animations moved to main CSS to avoid duplication --}}
