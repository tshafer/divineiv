@props([
    'action' => '/',
    'method' => 'POST',
    'showProgress' => true,
    'progressSteps' => null,
    'buttonText' => 'Send Message',
    'buttonIcon' => 'fas fa-paper-plane',
    'fields' => [
        'name' => ['required' => true, 'placeholder' => 'Your full name'],
        'email' => ['required' => true, 'placeholder' => 'your.email@example.com'],
        'phone' => ['required' => false, 'placeholder' => '(480) 555-0123'],
        'patient_status' => ['required' => false, 'type' => 'select', 'options' => ['New Patient', 'Existing Patient', 'Other']],
        'subject' => ['required' => false, 'placeholder' => 'Consultation, Service Inquiry, etc.'],
        'message' => ['required' => true, 'type' => 'textarea', 'placeholder' => 'Tell us about your wellness goals and how we can help you...']
    ]
])

<div class="modern-card">
    <div class="mb-8">
        <h2 class="heading-font text-3xl font-bold text-slate-800 mb-4">Send Us a Message</h2>
        <p class="text-gray-600 mb-6">Tell us about your wellness goals and we'll get back to you quickly.</p>

        @if($showProgress)
            <x-form-progress
                :steps="$progressSteps ?: [
                    ['name' => 'Fill Form', 'status' => 'active'],
                    ['name' => 'We Review', 'status' => 'pending'],
                    ['name' => 'We Contact You', 'status' => 'pending']
                ]"
            />
        @endif
    </div>

    @if(session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif

    @if(session('error'))
        <x-alert type="error" message="{{ session('error') }}" />
    @endif

    <form action="{{ $action }}" method="{{ $method }}" class="space-y-6">
        @csrf

        @if($method !== 'GET')
            @method($method)
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name and Email -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name @if($fields['name']['required'] ?? false)<span class="text-red-500">*</span>@endif
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    placeholder="{{ $fields['name']['placeholder'] ?? 'Your full name' }}"
                    {{ ($fields['name']['required'] ?? false) ? 'required' : '' }}
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email @if($fields['email']['required'] ?? false)<span class="text-red-500">*</span>@endif
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    placeholder="{{ $fields['email']['placeholder'] ?? 'your.email@example.com' }}"
                    {{ ($fields['email']['required'] ?? false) ? 'required' : '' }}
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Phone and Patient Status -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                    Phone Number @if($fields['phone']['required'] ?? false)<span class="text-red-500">*</span>@endif
                </label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    placeholder="{{ $fields['phone']['placeholder'] ?? '(480) 555-0123' }}"
                    {{ ($fields['phone']['required'] ?? false) ? 'required' : '' }}
                >
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="patient_status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Patient Status @if($fields['patient_status']['required'] ?? false)<span class="text-red-500">*</span>@endif
                </label>
                <select
                    id="patient_status"
                    name="patient_status"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                    {{ ($fields['patient_status']['required'] ?? false) ? 'required' : '' }}
                >
                    <option value="">Select status...</option>
                    @foreach(($fields['patient_status']['options'] ?? ['New Patient' => 'new', 'Existing Patient' => 'existing', 'Other' => 'other']) as $option)
                        @if(is_array($option))
                            <option value="{{ $option['value'] }}" {{ old('patient_status') == $option['value'] ? 'selected' : '' }}>{{ $option['label'] }}</option>
                        @elseif(is_string($option))
                            <option value="{{ Str::slug($option) }}" {{ old('patient_status') == Str::slug($option) ? 'selected' : '' }}>{{ $option }}</option>
                        @endif
                    @endforeach
                </select>
                @error('patient_status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Subject -->
        @if(isset($fields['subject']))
        <div>
            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                Subject @if($fields['subject']['required'] ?? false)<span class="text-red-500">*</span>@endif
            </label>
            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                placeholder="{{ $fields['subject']['placeholder'] ?? 'Consultation, Service Inquiry, etc.' }}"
                {{ ($fields['subject']['required'] ?? false) ? 'required' : '' }}
            >
            @error('subject')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        @endif

        <!-- Message -->
        @if(isset($fields['message']))
        <div>
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                Message @if($fields['message']['required'] ?? false)<span class="text-red-500">*</span>@endif
            </label>
            <textarea
                id="message"
                name="message"
                rows="6"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg contact-form-field focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                placeholder="{{ $fields['message']['placeholder'] ?? 'Tell us about your wellness goals and how we can help you...' }}"
                {{ ($fields['message']['required'] ?? false) ? 'required' : '' }}
            >{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        @endif

        <!-- Submit Button -->
        <div>
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold py-4 px-8 rounded-lg hover:from-cyan-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center group"
            >
                <i class="{{ $buttonIcon ?? 'fas fa-paper-plane' }} mr-3"></i>
                {{ $buttonText }}
                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>
    </form>
</div>
