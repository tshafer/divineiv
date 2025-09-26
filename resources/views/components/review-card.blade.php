@props([
    'review' => null,
    'aos' => 'fade-up',
    'delay' => 0
])

<div class="modern-card text-center group" data-aos="{{ $aos }}" data-aos-delay="{{ $delay }}">
    <!-- Stars -->
    <div class="flex justify-center text-yellow-400 mb-6">
        @for($i = 0; $i < $review->rating; $i++)
            <i class="fas fa-star text-2xl"></i>
        @endfor
    </div>

    <!-- Quote -->
    <blockquote class="text-gray-700 text-xl leading-relaxed mb-8 italic relative">
        <i class="fas fa-quote-left text-blue-400 text-4xl mb-4 block"></i>
        "{{ $review->content }}"
    </blockquote>

    <!-- Author Info -->
    <div class="border-t border-gray-200 pt-6">
        <div class="flex items-center">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                {{ strtoupper(substr($review->author_name, 0, 1)) }}
            </div>
            <div class="text-left flex-1">
                <div class="font-bold text-gray-800 heading-font text-lg">{{ $review->author_name }}</div>
                @if($review->source)
                    <div class="text-sm text-gray-500 flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        {{ $review->source }}
                    </div>
                @endif
                <div class="text-sm text-gray-400 mt-1">
                    {{ $review->created_at->format('M j, Y') }}
                </div>
            </div>
        </div>
    </div>
</div>
