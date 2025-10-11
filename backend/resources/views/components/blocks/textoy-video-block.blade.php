@php
    $backgroundColor = $block['backgroundColor'] ?? '#ffffff';
    $titleColor = $block['titleColor'] ?? '#000000';
    $descriptionColor = $block['descriptionColor'] ?? '#666666';
    $buttonColor = $block['buttonColor'] ?? '#007bff';
    $buttonTextColor = $block['buttonTextColor'] ?? '#ffffff';
    $videoType = $block['videoType'] ?? 'youtube';
    $videoUrl = $block['videoUrl'] ?? '';
    $customId = $block['customId'] ?? '';
    $customClass = $block['customClass'] ?? '';

    // Extract YouTube ID if YouTube video
    $youtubeId = '';
    if ($videoType === 'youtube' && $videoUrl) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
            $youtubeId = $matches[1];
        } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoUrl)) {
            $youtubeId = $videoUrl;
        }
    }
@endphp

<div class="textoy-video-block-content {{ $customClass }}"
     @if($customId) id="{{ $customId }}" @endif>

    @if(isset($block['customCSS']) && $block['customCSS'])
        <style>
            {!! $block['customCSS'] !!}
        </style>
    @endif

    <div class="textoy-video-inner"
         style="background-color: {{ $backgroundColor }}; padding: 4rem 2rem;">

        <div class="textoy-video-container"
             style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">

            <div class="text-content">
                @if(isset($block['title']) && $block['title'])
                    <h2 class="text-title"
                        style="color: {{ $titleColor }}; font-size: 2rem; font-weight: 600; margin-bottom: 1.5rem; line-height: 1.3;">
                        {{ $block['title'] }}
                    </h2>
                @endif

                @if(isset($block['description']) && $block['description'])
                    <div class="text-description"
                         style="color: {{ $descriptionColor }}; font-size: 1rem; line-height: 1.6; margin-bottom: 2rem;">
                        {!! $block['description'] !!}
                    </div>
                @endif

                @if(isset($block['buttonText']) && $block['buttonText'])
                    <div class="text-actions">
                        <a href="{{ $block['buttonLink'] ?? '#' }}"
                           class="text-button"
                           style="display: inline-block; background-color: {{ $buttonColor }}; color: {{ $buttonTextColor }}; padding: 0.75rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                            {{ $block['buttonText'] }}
                        </a>
                    </div>
                @endif
            </div>

            <div class="video-content">
                @if($videoType === 'youtube' && $youtubeId)
                    <div class="video-embed"
                         style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px;">
                        <iframe
                            src="https://www.youtube.com/embed/{{ $youtubeId }}"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy">
                        </iframe>
                    </div>
                @elseif($videoType === 'media' && isset($block['videoUrl']) && $block['videoUrl'])
                    <div class="video-player"
                         style="border-radius: 12px; overflow: hidden;">
                        <video
                            controls
                            style="width: 100%; height: auto; display: block;">
                            <source src="{{ $block['videoUrl'] }}" type="video/mp4">
                            Tu navegador no soporta el elemento video.
                        </video>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .text-button:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .textoy-video-container {
            grid-template-columns: 1fr !important;
        }

        .textoy-video-inner {
            padding: 2rem 1rem !important;
        }

        .text-title {
            font-size: 1.5rem !important;
        }
    }
</style>