<div class="banner-integra-block-content">
    <div class="banner-inner" 
         @if(isset($block['data']['backgroundColor'])) 
             style="background-color: {{ $block['data']['backgroundColor'] }};" 
         @endif>
        
        @if(isset($block['data']['backgroundImage']))
            <div class="banner-background">
                <img src="{{ $block['data']['backgroundImage'] }}" 
                     alt="Background" 
                     class="banner-bg-image"
                     loading="lazy">
            </div>
        @endif
        
        <div class="banner-content">
            @if(isset($block['data']['title']))
                <h1 class="banner-title">{{ $block['data']['title'] }}</h1>
            @endif
            
            @if(isset($block['data']['subtitle']))
                <h2 class="banner-subtitle">{{ $block['data']['subtitle'] }}</h2>
            @endif
            
            @if(isset($block['data']['description']))
                <p class="banner-description">{{ $block['data']['description'] }}</p>
            @endif
            
            @if(isset($block['data']['cta']) && is_array($block['data']['cta']))
                <div class="banner-actions">
                    @foreach($block['data']['cta'] as $cta)
                        <a href="{{ $cta['url'] ?? '#' }}" 
                           class="banner-button {{ $cta['style'] ?? 'primary' }}"
                           @if(isset($cta['target'])) target="{{ $cta['target'] }}" @endif>
                            {{ $cta['text'] ?? 'Más información' }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>