<div class="services-block-content">
    @if(isset($block['data']['title']))
        <h2 class="services-title">{{ $block['data']['title'] }}</h2>
    @endif
    
    @if(isset($block['data']['services']) && is_array($block['data']['services']))
        <div class="services-grid">
            @foreach($block['data']['services'] as $service)
                <div class="service-item">
                    @if(isset($service['icon']))
                        <div class="service-icon">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                    @endif
                    
                    @if(isset($service['title']))
                        <h3 class="service-title">{{ $service['title'] }}</h3>
                    @endif
                    
                    @if(isset($service['description']))
                        <p class="service-description">{{ $service['description'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>