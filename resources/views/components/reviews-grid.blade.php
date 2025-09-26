@props([
    'reviews' => [],
    'title' => '',
    'description' => ''
])

@if($title || $description)
<div class="text-center mb-12" data-aos="fade-up">
    @if($title)
        <h2 class="heading-font text-4xl font-bold text-slate-800 mb-4">{{ $title }}</h2>
    @endif
    @if($description)
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $description }}</p>
    @endif
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($reviews as $index => $review)
        <x-review-card
            :review="$review"
            aos="fade-up"
            :delay="$index * 100"
        />
    @endforeach
</div>
