<div class="cualidades-block-content">
    @if(isset($block['data']['title']))
        <h2 class="cualidades-title">{{ $block['data']['title'] }}</h2>
    @endif
    
    @if(isset($block['data']['cualidades']) && is_array($block['data']['cualidades']))
        <div class="cualidades-grid">
            @foreach($block['data']['cualidades'] as $cualidad)
                <div class="cualidad-item">
                    @if(isset($cualidad['icon']))
                        <div class="cualidad-icon">
                            <i class="{{ $cualidad['icon'] }}"></i>
                        </div>
                    @endif
                    
                    @if(isset($cualidad['title']))
                        <h3 class="cualidad-title">{{ $cualidad['title'] }}</h3>
                    @endif
                    
                    @if(isset($cualidad['description']))
                        <p class="cualidad-description">{{ $cualidad['description'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>