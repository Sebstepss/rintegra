@php
    $height = $block['height'] ?? 50;
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
@endphp

<div class="spacer-block"
     style="height: {{ $height }}px; background-color: {{ $backgroundColor }}; width: 100%;"></div>