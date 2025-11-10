@php
    $layoutMode = $block['layoutMode'] ?? 'two-column';
    $aspectRatio = $block['aspectRatio'] ?? '16:9';
    $backgroundColor = $block['backgroundColor'] ?? '#ffffff';
    $customId = $block['customId'] ?? '';
    $customClass = $block['customClass'] ?? '';

    // Map aspect ratios to CSS values
    $aspectRatioMap = [
        '4:5' => '4 / 5',
        '16:9' => '16 / 9',
        '9:16' => '9 / 16',
        '1:1' => '1 / 1'
    ];
    $aspectRatioCSS = $aspectRatioMap[$aspectRatio] ?? '16 / 9';

    // Gap mapping for multi-column
    $gapMap = [
        'small' => '1rem',
        'medium' => '2rem',
        'large' => '3rem'
    ];
    $gap = $gapMap[$block['gap'] ?? 'medium'] ?? '2rem';

    // Function to extract video embed URLs
    function getYoutubeEmbedUrl($url) {
        if (!$url) return null;

        $videoId = '';
        // YouTube Shorts
        if (str_contains($url, 'youtube.com/shorts/')) {
            preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/', $url, $matches);
            $videoId = $matches[1] ?? '';
        }
        // Regular YouTube
        elseif (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // Just the ID
        elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            $videoId = $url;
        }

        return $videoId ? "https://www.youtube.com/embed/{$videoId}?rel=0" : null;
    }

    function getVimeoEmbedUrl($url) {
        if (!$url) return null;

        $videoId = '';
        if (str_contains($url, 'vimeo.com/')) {
            $parts = explode('vimeo.com/', $url);
            $videoId = explode('?', $parts[1] ?? '')[0];
            $videoId = explode('#', $videoId)[0];
        } else {
            $videoId = $url;
        }

        return $videoId ? "https://player.vimeo.com/video/{$videoId}" : null;
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

        @if($layoutMode === 'two-column')
            {{-- Layout: Dos Columnas (Texto + Video) --}}
            @php
                $titleColor = $block['titleColor'] ?? '#000000';
                $descriptionColor = $block['descriptionColor'] ?? '#666666';
                $buttonColor = $block['buttonColor'] ?? '#007bff';
                $buttonTextColor = $block['buttonTextColor'] ?? '#ffffff';
                $videoType = $block['videoType'] ?? 'youtube';
                $videoUrl = $block['videoUrl'] ?? '';
            @endphp

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
                    @php
                        $embedUrl = null;
                        if ($videoType === 'youtube') {
                            $embedUrl = getYoutubeEmbedUrl($videoUrl);
                        } elseif ($videoType === 'vimeo') {
                            $embedUrl = getVimeoEmbedUrl($videoUrl);
                        }
                    @endphp

                    @if($videoType === 'youtube' && $embedUrl)
                        <div class="video-embed"
                             style="width: 100%; aspect-ratio: {{ $aspectRatioCSS }}; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                            <iframe
                                src="{{ $embedUrl }}"
                                style="width: 100%; height: 100%; border: 0;"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        </div>
                    @elseif($videoType === 'vimeo' && $embedUrl)
                        <div class="video-embed"
                             style="width: 100%; aspect-ratio: {{ $aspectRatioCSS }}; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                            <iframe
                                src="{{ $embedUrl }}"
                                style="width: 100%; height: 100%; border: 0;"
                                frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        </div>
                    @elseif($videoType === 'media' && $videoUrl)
                        <div class="video-player"
                             style="border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                            <video
                                controls
                                style="width: 100%; height: auto; display: block; aspect-ratio: {{ $aspectRatioCSS }}; object-fit: cover;">
                                <source src="{{ $videoUrl }}" type="video/mp4">
                                Tu navegador no soporta el elemento video.
                            </video>
                        </div>
                    @endif
                </div>
            </div>

        @else
            {{-- Layout: Múltiples Columnas --}}
            @php
                $columnsCount = $block['columnsCount'] ?? 2;
                $columns = $block['columns'] ?? [];
            @endphp

            <div class="multi-column-videos"
                 style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat({{ $columnsCount }}, 1fr); gap: {{ $gap }}; justify-items: center;">

                @foreach($columns as $column)
                    @php
                        $colVideoType = $column['videoType'] ?? 'youtube';
                        $colVideoUrl = $column['videoUrl'] ?? '';
                        $colTitle = $column['title'] ?? '';
                        $colDescription = $column['description'] ?? '';

                        $colEmbedUrl = null;
                        if ($colVideoType === 'youtube') {
                            $colEmbedUrl = getYoutubeEmbedUrl($colVideoUrl);
                        } elseif ($colVideoType === 'vimeo') {
                            $colEmbedUrl = getVimeoEmbedUrl($colVideoUrl);
                        }
                    @endphp

                    <div class="video-card"
                         style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">

                        {{-- Video --}}
                        @if($colVideoType === 'youtube' && $colEmbedUrl)
                            <div class="video-card-media"
                                 style="width: 100%; aspect-ratio: {{ $aspectRatioCSS }}; overflow: hidden;">
                                <iframe
                                    src="{{ $colEmbedUrl }}"
                                    style="width: 100%; height: 100%; border: 0;"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>
                            </div>
                        @elseif($colVideoType === 'vimeo' && $colEmbedUrl)
                            <div class="video-card-media"
                                 style="width: 100%; aspect-ratio: {{ $aspectRatioCSS }}; overflow: hidden;">
                                <iframe
                                    src="{{ $colEmbedUrl }}"
                                    style="width: 100%; height: 100%; border: 0;"
                                    frameborder="0"
                                    allow="autoplay; fullscreen; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>
                            </div>
                        @elseif($colVideoType === 'media' && $colVideoUrl)
                            <div class="video-card-media"
                                 style="width: 100%; aspect-ratio: {{ $aspectRatioCSS }}; overflow: hidden;">
                                <video
                                    controls
                                    style="width: 100%; height: 100%; display: block; object-fit: cover;">
                                    <source src="{{ $colVideoUrl }}" type="video/mp4">
                                    Tu navegador no soporta el elemento video.
                                </video>
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="video-card-content"
                             style="padding: 1.5rem;">
                            @if($colTitle)
                                <h3 class="video-card-title"
                                    style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem; color: #2c3e50;">
                                    {{ $colTitle }}
                                </h3>
                            @endif
                            @if($colDescription)
                                <p class="video-card-description"
                                   style="font-size: 0.95rem; line-height: 1.6; color: #666; margin: 0;">
                                    {{ $colDescription }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .multi-column-videos {
        max-width: 1200px !important;
    }
    .video-content{
        width: 50%;
        margin:auto
    }

    .text-button:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .video-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
    }

    /* Tamaño máximo de video-cards en desktop según aspect ratio */
    .video-card {
        width: 100%;
        max-width: 100%;
        margin: auto;
    }

    

    @media (max-width: 1024px) {
        .multi-column-videos {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        /* En tablet, ajustar tamaños */
        .multi-column-videos .video-card {
            max-width: 400px;
        }
    }

    @media (max-width: 768px) {
        .video-card {
            width: 100%;
            max-width: 100%;
            margin: auto;
        }
         .video-content{
        width: 80%;
        margin:auto
    }

        .textoy-video-container {
            grid-template-columns: 1fr !important;
        }

        .multi-column-videos {
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
