@php
    $gradientStart = $block['backgroundGradient']['colorStart'] ?? '#052b1b';
    $gradientEnd = $block['backgroundGradient']['colorEnd'] ?? '#0c6a44';
    $titleColor = $block['titleColor'] ?? '#ffffff';
    $descriptionColor = $block['descriptionColor'] ?? '#ffffff';
    $backgroundImage = $block['backgroundImage'] ?? '';
    $backgroundImageOpacity = ($block['backgroundImageOpacity'] ?? 30) / 100;
    $customId = $block['customId'] ?? '';
    $customClass = $block['customClass'] ?? '';
@endphp

<div class="banner-integra-block-content {{ $customClass }}"
     @if($customId) id="{{ $customId }}" @endif>

    @if(isset($block['customCSS']) && $block['customCSS'])
        <style>
            {!! $block['customCSS'] !!}
        </style>
    @endif

    <div class="banner-inner"
         style="background: radial-gradient(circle at center, {{ $gradientStart }}, {{ $gradientEnd }}); position: relative; min-height: 500px; display: flex; align-items: center; padding: 4rem 2rem; overflow: hidden;">

        @if($backgroundImage)
            <div class="banner-background"
                 style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: hidden;">
                <img src="{{ $backgroundImage }}"
                     alt="Background"
                     style="width: 100%; height: 100%; object-fit: cover; opacity: {{ $backgroundImageOpacity }};"
                     loading="lazy">
            </div>
        @endif

        <div class="banner-content-wrapper"
             style="max-width: 1400px; margin: 0 auto; width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: center; position: relative; z-index: 2;">

            <div class="banner-content">
                @if(isset($block['title']) && $block['title'])
                    <h1 class="banner-title"
                        style="color: {{ $titleColor }}; font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.2;">
                        {{ $block['title'] }}
                    </h1>
                @endif

                @if(isset($block['description']) && $block['description'])
                    <p class="banner-description"
                       style="color: {{ $descriptionColor }}; font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem;">
                        {{ $block['description'] }}
                    </p>
                @endif

                @if(isset($block['buttonText']) && $block['buttonText'])
                    <div class="banner-actions">
                        <a href="{{ $block['buttonLink'] ?? '#' }}"
                           class="banner-button"
                           style="display: inline-block; background: white; color: #052b1b; padding: 1rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                            {{ $block['buttonText'] }}
                        </a>
                    </div>
                @endif
            </div>

            @if(isset($block['personImage']) && $block['personImage'])
                <div class="banner-person"
                     style="display: flex; justify-content: center; align-items: center;">
                    <img src="{{ $block['personImage'] }}"
                         alt="Person"
                         style="max-width: 100%; height: auto; object-fit: contain; max-height: 500px;"
                         loading="lazy">
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .banner-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3) !important;
    }

    @media (max-width: 768px) {
        .banner-content-wrapper {
            grid-template-columns: 1fr !important;
        }

        .banner-title {
            font-size: 2rem !important;
        }

        .banner-description {
            font-size: 1rem !important;
        }

        .banner-inner {
            min-height: 400px !important;
            padding: 2rem 1rem !important;
        }
    }
</style>