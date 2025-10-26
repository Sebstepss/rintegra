@php
    $gradientStart = $block['backgroundGradient']['colorStart'] ?? '#052b1b';
    $gradientEnd = $block['backgroundGradient']['colorEnd'] ?? '#0c6a44';
    $titleColor = $block['titleColor'] ?? '#ffffff';
    $itemsTextColor = $block['itemsTextColor'] ?? '#ffffff';
    $customId = $block['customId'] ?? '';
    $customClass = $block['customClass'] ?? '';
@endphp

<div class="cualidades-block-content {{ $customClass }}"
     @if($customId) id="{{ $customId }}" @endif>

    @if(isset($block['customCSS']) && $block['customCSS'])
        <style>
            {!! $block['customCSS'] !!}
        </style>
    @endif

    <div class="cualidades-inner"
         style="background: radial-gradient(circle at center, {{ $gradientStart }}, {{ $gradientEnd }}); padding: 4rem 2rem;">

        <div class="cualidades-container"
             style="max-width: 1400px; margin: 0 auto;">

            @if(isset($block['title']) && $block['title'])
                <h2 class="cualidades-title"
                    style="color: {{ $titleColor }}; text-align: center; font-size: 2rem; font-weight: 600; margin-bottom: 3rem;">
                    {{ $block['title'] }}
                </h2>
            @endif

            @if(isset($block['items']) && is_array($block['items']))
                <div class="cualidades-grid"
                     style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    @foreach($block['items'] as $item)
                        <div class="cualidad-item"
                             style="text-align: center; padding: 1.5rem;">

                            @if(isset($item['image']) && $item['image'])
                                <div class="cualidad-image"
                                     style="margin-bottom: 1rem;">
                                    <img src="{{ $item['image'] }}"
                                         alt="{{ $item['text'] ?? 'Cualidad' }}"
                                         style="width: 80px; height: 80px; object-fit: contain; margin: 0 auto; display: block;"
                                         loading="lazy">
                                </div>
                            @endif

                            @if(isset($item['text']) && $item['text'])
                                <p class="cualidad-text"
                                   style="color: {{ $item['textColor'] ?? $itemsTextColor }}; font-size: 1rem; line-height: 1.5; margin: 0;">
                                    {{ $item['text'] }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .cualidades-grid {
            grid-template-columns: 1fr !important;
        }

        .cualidades-inner {
            padding: 2rem 1rem !important;
        }

        .cualidades-title {
            font-size: 1.5rem !important;
        }
    }
</style>