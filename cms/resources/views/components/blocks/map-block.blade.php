@php
    $title = $block['title'] ?? '';
    $embedCode = $block['embedCode'] ?? '';
    $address = $block['address'] ?? '';
    $height = $block['height'] ?? 400;
    $padding = $block['padding'] ?? 'medium';

    $paddingMap = ['none' => '0', 'small' => '2rem', 'medium' => '4rem', 'large' => '6rem'];
    $paddingValue = $paddingMap[$padding] ?? '4rem';
@endphp

<div class="map-block-content" style="padding: {{ $paddingValue }};">
    <div class="map-container-wrapper" style="max-width: 1400px; margin: 0 auto;">
        @if($title)
            <h2 class="map-title" style="text-align: center; font-size: 2rem; font-weight: 600; margin-bottom: 2rem; color: #2c3e50;">
                {{ $title }}
            </h2>
        @endif

        @if($embedCode)
            <div class="map-embed" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                {!! $embedCode !!}
            </div>
        @elseif($address)
            <div class="map-embed" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                <iframe
                    src="https://www.google.com/maps?q={{ urlencode($address) }}&output=embed"
                    width="100%"
                    height="{{ $height }}"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            @if($address)
                <div class="map-address" style="text-align: center; margin-top: 1.5rem; color: #6c757d;">
                    <p style="margin: 0;">
                        <i class="fas fa-map-marker-alt" style="color: #0a5a39; margin-right: 0.5rem;"></i>
                        <strong>Dirección:</strong> {{ $address }}
                    </p>
                </div>
            @endif
        @endif
    </div>
</div>

<style>
    .map-embed iframe {
        display: block;
        width: 100%;
    }

    @media (max-width: 768px) {
        .map-block-content {
            padding: 2rem 1rem !important;
        }
    }
</style>
