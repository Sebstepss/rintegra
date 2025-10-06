<div class="textoy-video-block-content">
    <div class="text-video-container">
        @if(isset($block['data']['text']))
            <div class="text-content">
                {!! $block['data']['text'] !!}
            </div>
        @endif
        
        @if(isset($block['data']['video']))
            <div class="video-content">
                @if(isset($block['data']['video']['type']) && $block['data']['video']['type'] === 'embed')
                    {{-- Video embebido (YouTube, Vimeo, etc.) --}}
                    <div class="video-embed">
                        {!! $block['data']['video']['embed_code'] !!}
                    </div>
                @elseif(isset($block['data']['video']['url']))
                    {{-- Video directo --}}
                    <video controls 
                           @if(isset($block['data']['video']['poster'])) poster="{{ $block['data']['video']['poster'] }}" @endif
                           class="video-player">
                        <source src="{{ $block['data']['video']['url'] }}" 
                                type="{{ $block['data']['video']['mime_type'] ?? 'video/mp4' }}">
                        Tu navegador no soporta el elemento video.
                    </video>
                @endif
            </div>
        @endif
    </div>
</div>