@props([
    'id' => 'contact-map',
    'coordinates' => [33.2488454, -111.8658575],
    'zoom' => 16,
    'markerTitle' => 'Divine IV & Wellness',
    'markerAddress' => '3930 S Alma School Rd Suite 10<br>Chandler, AZ 85248',
    'markerPhone' => '(480) 488-9858',
    'markerHours' => 'Mon/Fri 9 AM - 5 PM',
    'height' => 'h-96',
    'containerClass' => 'rounded-2xl overflow-hidden shadow-xl border-4 border-cyan-100 hover:shadow-2xl transform transition-all duration-500 hover:scale-105',
    'sectionTitle' => 'Find Our Chandler Location',
    'sectionDescription' => 'Located in the heart of Chandler, Arizona, we\'re easy to find and conveniently accessible for your wellness appointments.',
    'additionalCards' => []
])

{{-- Include Leaflet CSS and JS --}}
@once
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endonce

<div class="py-16 bg-gradient-to-b from-slate-50 to-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        @if($sectionTitle)
        <div class="text-center mb-12" data-aos="fade-up" data-aos-delay="200">
            <h2 class="heading-font text-4xl font-bold text-slate-800 mb-4 animate-fade-in-up">{{ $sectionTitle }}</h2>
            @if($sectionDescription)
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ $sectionDescription }}
                </p>
            @endif
        </div>
        @endif

        <div class="{{ $containerClass }}" data-aos="zoom-in" data-aos-delay="400">
            <div id="{{ $id }}" class="w-full {{ $height }}"></div>
        </div>

        @if(count($additionalCards) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            @foreach($additionalCards as $index => $card)
                <x-interactive-card
                    :icon="$card['icon'] ?? 'fas fa-star'"
                    :title="$card['title'] ?? 'Sample Title'"
                    :content="$card['content'] ?? 'Sample content'"
                    :delay="600 + ($index * 100)"
                    data-aos="fade-up"
                />
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let map_{{ md5($id) }};

    function initMap_{{ md5($id) }}() {
        const location = {!! json_encode($coordinates) !!};
        const zoom = {{ $zoom }};

        map_{{ md5($id) }} = L.map('{{ $id }}').setView(location, zoom);

        // Add OpenStreetMap tiles (completely free)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map_{{ md5($id) }});

        // Create custom marker icon
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: `
                <div style="
                    width: 40px;
                    height: 40px;
                    background: linear-gradient(135deg, #0891b2, #1e293b);
                    border: 3px solid white;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    animation: pulse 2s infinite;
                ">
                    <i class="fas fa-map-marker-alt" style="color: white; font-size: 16px;"></i>
                </div>
            `,
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });

        // Add marker
        const marker = L.marker(location, { icon: customIcon }).addTo(map_{{ md5($id) }});

        // Add popup
        marker.bindPopup(`
            <div style="padding: 12px; max-width: 280px; font-family: 'Inter', sans-serif;">
                <h3 style="color: #1e293b; margin: 0 0 8px 0; font-weight: bold; font-size: 16px;">{{ $markerTitle }}</h3>
                <div style="color: #64748b; font-size: 13px;">
                    <div style="margin: 4px 0;"><strong>📍</strong> {!! $markerAddress !!}</div>
                    <div style="margin: 4px 0;"><strong>📞</strong> {{ $markerPhone }}</div>
                    <div style="margin: 4px 0;"><strong>🕒</strong> {{ $markerHours }}</div>
                </div>
            </div>
        `).openPopup();
    }

    // Initialize map when page loads
    if (typeof document.getElementById('{{ $id }}') === 'object') {
        initMap_{{ md5($id) }}();
    }
});
</script>
