@props([
    'steps' => [
        ['name' => 'Fill Form', 'status' => 'active'],
        ['name' => 'We Review', 'status' => 'pending'],
        ['name' => 'We Contact You', 'status' => 'pending']
    ],
    'currentStep' => 1
])

@php
    // If currentStep is provided, update the steps array
    if (isset($currentStep)) {
        foreach ($steps as $index => &$step) {
            $stepIndex = $index + 1;
            if ($stepIndex < $currentStep) {
                $step['status'] = 'completed';
            } elseif ($stepIndex == $currentStep) {
                $step['status'] = 'active';
            } else {
                $step['status'] = 'pending';
            }
        }
    }
@endphp

<div class="flex items-center space-x-2 mb-6">
    @foreach($steps as $index => $step)
        @php
            $isFirst = $index === 0;
            $isLast = $index === count($steps) - 1;
        @endphp

        <div class="flex items-center">
            <div @class([
                'w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-colors',
                match($step['status']) {
                    'completed' => 'bg-cyan-600 text-white',
                    'active' => 'bg-cyan-600 text-white',
                    'pending' => 'bg-gray-200 text-gray-500'
                }
            ])>
                @if($step['status'] === 'completed')
                    <i class="fas fa-check text-sm"></i>
                @else
                    {{ $stepIndex = $index + 1 }}
                @endif
            </div>
            <span @class([
                'ml-2 text-sm font-medium transition-colors',
                match($step['status']) {
                    'completed' => 'text-gray-700',
                    'active' => 'text-gray-700',
                    'pending' => 'text-gray-500'
                }
            ])>
                {{ $step['name'] }}
            </span>
        </div>

        @if(!$isLast)
            <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
        @endif
    @endforeach
</div>
