<div class="text-block-content" 
     style="display: grid; grid-template-columns: repeat({{ $block['columnsCount'] ?? 1 }}, 1fr); gap: {{ $block['gap'] === 'small' ? '1rem' : ($block['gap'] === 'large' ? '3rem' : '2rem') }}; padding: {{ $block['padding'] === 'small' ? '1rem' : ($block['padding'] === 'large' ? '4rem' : '2rem') }}; background-color: {{ $block['backgroundColor'] ?? 'transparent' }};">
    @if(isset($block['columns']) && is_array($block['columns']))
        @foreach($block['columns'] as $column)
            <div class="text-column" 
                 style="background-color: {{ $column['backgroundColor'] ?? 'transparent' }}; color: {{ $column['textColor'] ?? 'inherit' }};">
                @if(isset($column['texts']) && is_array($column['texts']))
                    @foreach($column['texts'] as $text)
                        {!! $text['content'] ?? '' !!}
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>
