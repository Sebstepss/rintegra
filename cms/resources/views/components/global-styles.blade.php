@php
    // Cargar configuración global desde la base de datos
    $globalsConfig = null;
    try {
        $config = \App\Models\SiteConfiguration::where('config_type', 'globals')
            ->where('is_active', true)
            ->latest()
            ->first();

        if ($config && $config->config_data) {
            $globalsConfig = is_string($config->config_data)
                ? json_decode($config->config_data, true)
                : $config->config_data;
        }
    } catch (\Exception $e) {
        \Log::error('Error loading globals config: ' . $e->getMessage());
    }

    // Configuración por defecto
    $defaultConfig = [
        'baseFontFamily' => "'Lato', sans-serif",
        'typography' => [
            'h1' => ['fontFamily' => 'inherit', 'fontSize' => 48, 'fontWeight' => '700', 'letterSpacing' => 0],
            'h2' => ['fontFamily' => 'inherit', 'fontSize' => 36, 'fontWeight' => '600', 'letterSpacing' => 0],
            'h3' => ['fontFamily' => 'inherit', 'fontSize' => 28, 'fontWeight' => '600', 'letterSpacing' => 0],
            'h4' => ['fontFamily' => 'inherit', 'fontSize' => 24, 'fontWeight' => '600', 'letterSpacing' => 0],
            'h5' => ['fontFamily' => 'inherit', 'fontSize' => 20, 'fontWeight' => '600', 'letterSpacing' => 0],
            'h6' => ['fontFamily' => 'inherit', 'fontSize' => 18, 'fontWeight' => '600', 'letterSpacing' => 0],
            'p' => ['fontFamily' => 'inherit', 'fontSize' => 16, 'fontWeight' => '400', 'letterSpacing' => 0]
        ],
        'colorPalette' => ['#007bff', '#17a2b8', '#28a745', '#dc3545', '#ffc107', '#6c757d', '#343a40'],
        'buttons' => [
            'outline' => ['borderColor' => '#007bff', 'textColor' => '#007bff', 'borderRadius' => 8, 'borderWidth' => 2],
            'flat' => ['backgroundColor' => '#007bff', 'textColor' => '#ffffff', 'borderRadius' => 8],
            'gradient' => ['color1' => '#007bff', 'color2' => '#0056b3', 'color3' => '#004085', 'textColor' => '#ffffff', 'borderRadius' => 8]
        ]
    ];

    // Merge profundo con configuración por defecto
    if (!$globalsConfig) {
        $globalsConfig = $defaultConfig;
    } else {
        // Merge profundo para preservar estructuras anidadas
        $globalsConfig = array_replace_recursive($defaultConfig, $globalsConfig);
    }

    // Asegurar que existen todas las propiedades necesarias
    if (!isset($globalsConfig['typography'])) {
        $globalsConfig['typography'] = $defaultConfig['typography'];
    }
    if (!isset($globalsConfig['colorPalette'])) {
        $globalsConfig['colorPalette'] = $defaultConfig['colorPalette'];
    }
    if (!isset($globalsConfig['buttons'])) {
        $globalsConfig['buttons'] = $defaultConfig['buttons'];
    }

    // Helper para extraer nombre de fuente Google de la cadena CSS
    function extractGoogleFont($fontFamilyString) {
        // Eliminar espacios extra
        $fontFamilyString = trim($fontFamilyString);

        // Buscar entre comillas simples: 'Lato'
        if (preg_match("/'([^']+)'/", $fontFamilyString, $matches)) {
            $fontName = $matches[1];
        }
        // Buscar entre comillas dobles: "Lato"
        elseif (preg_match('/"([^"]+)"/', $fontFamilyString, $matches)) {
            $fontName = $matches[1];
        }
        // Sin comillas, tomar primera palabra antes de coma
        else {
            $parts = explode(',', $fontFamilyString);
            $fontName = trim($parts[0]);
        }

        // Lista de fuentes de sistema que NO son Google Fonts
        $systemFonts = [
            'Arial', 'Helvetica', 'Times New Roman', 'Times', 'Courier New',
            'Courier', 'Verdana', 'Georgia', 'Palatino', 'Garamond',
            'Bookman', 'Comic Sans MS', 'Trebuchet MS', 'Impact',
            'sans-serif', 'serif', 'monospace', 'cursive', 'fantasy',
            'system-ui', 'inherit'
        ];

        if (in_array($fontName, $systemFonts)) {
            return null;
        }

        return $fontName;
    }

    // Extraer Google Fonts necesarias
    $fontsToLoad = [];
    $baseFontFamily = $globalsConfig['baseFontFamily'] ?? "'Lato', sans-serif";

    // Extraer nombre de la fuente base
    $baseFont = extractGoogleFont($baseFontFamily);
    if ($baseFont) {
        $fontsToLoad[] = $baseFont;
    }

    // Extraer fuentes de los elementos de tipografía
    foreach ($globalsConfig['typography'] ?? [] as $config) {
        $fontFamily = $config['fontFamily'] ?? 'inherit';
        if ($fontFamily !== 'inherit') {
            $font = extractGoogleFont($fontFamily);
            if ($font) {
                $fontsToLoad[] = $font;
            }
        }
    }

    $fontsToLoad = array_unique($fontsToLoad);
@endphp

{{-- Cargar Google Fonts --}}
@if(count($fontsToLoad) > 0)
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?{{ implode('&', array_map(function($font) { return 'family=' . str_replace(' ', '+', $font) . ':wght@100;200;300;400;500;600;700;800;900'; }, $fontsToLoad)) }}&display=swap" rel="stylesheet">
@endif

{{-- Debug: Mostrar configuración cargada (solo visible en el código fuente) --}}
<!-- Global Styles Config Loaded:
Base Font: {{ $globalsConfig['baseFontFamily'] ?? 'NOT SET' }}
Typography Elements: {{ count($globalsConfig['typography'] ?? []) }}
Color Palette: {{ count($globalsConfig['colorPalette'] ?? []) }} colors
-->

{{-- CSS Variables Globales --}}
<style>
    :root {
        /* Fuente base */
        --base-font-family: {!! $globalsConfig['baseFontFamily'] ?? "'Lato', sans-serif" !!};

        @foreach(($globalsConfig['typography'] ?? []) as $element => $config)
            @php
                $fontFamily = ($config['fontFamily'] ?? 'inherit') === 'inherit'
                    ? ($globalsConfig['baseFontFamily'] ?? "'Lato', sans-serif")
                    : $config['fontFamily'];
                $fontWeight = ($config['fontWeight'] ?? 'inherit') === 'inherit' ? 'normal' : $config['fontWeight'];
                $fontSize = $config['fontSize'] ?? 16;
                $letterSpacing = $config['letterSpacing'] ?? 0;
            @endphp
            /* Tipografía {{ $element }} */
            --font-family-{{ $element }}: {!! $fontFamily !!};
            --font-size-{{ $element }}: {{ $fontSize }}px;
            --font-weight-{{ $element }}: {{ $fontWeight }};
            --letter-spacing-{{ $element }}: {{ $letterSpacing }}px;
        @endforeach

        /* Paleta de colores */
        @foreach(($globalsConfig['colorPalette'] ?? []) as $index => $color)
            --color-{{ $index + 1 }}: {{ $color }};
        @endforeach

        /* Estilos de botones - Outline */
        --btn-outline-border-color: {{ $globalsConfig['buttons']['outline']['borderColor'] ?? '#007bff' }};
        --btn-outline-text-color: {{ $globalsConfig['buttons']['outline']['textColor'] ?? '#007bff' }};
        --btn-outline-border-radius: {{ $globalsConfig['buttons']['outline']['borderRadius'] ?? 8 }}px;
        --btn-outline-border-width: {{ $globalsConfig['buttons']['outline']['borderWidth'] ?? 2 }}px;

        /* Estilos de botones - Flat */
        --btn-flat-bg-color: {{ $globalsConfig['buttons']['flat']['backgroundColor'] ?? '#007bff' }};
        --btn-flat-text-color: {{ $globalsConfig['buttons']['flat']['textColor'] ?? '#ffffff' }};
        --btn-flat-border-radius: {{ $globalsConfig['buttons']['flat']['borderRadius'] ?? 8 }}px;

        /* Estilos de botones - Gradient */
        --btn-gradient-color-1: {{ $globalsConfig['buttons']['gradient']['color1'] ?? '#007bff' }};
        --btn-gradient-color-2: {{ $globalsConfig['buttons']['gradient']['color2'] ?? '#0056b3' }};
        --btn-gradient-color-3: {{ $globalsConfig['buttons']['gradient']['color3'] ?? '#004085' }};
        --btn-gradient-text-color: {{ $globalsConfig['buttons']['gradient']['textColor'] ?? '#ffffff' }};
        --btn-gradient-border-radius: {{ $globalsConfig['buttons']['gradient']['borderRadius'] ?? 8 }}px;
    }

    /* Aplicar estilos globales base */
    body {
        font-family: var(--base-font-family);
        margin: 0;
        padding: 0;
        color: #2c3e50;
    }

    /* Clases de botones globales */
    .btn-outline {
        border: var(--btn-outline-border-width) solid var(--btn-outline-border-color);
        color: var(--btn-outline-text-color);
        background-color: transparent;
        border-radius: var(--btn-outline-border-radius);
        padding: 0.75rem 1.5rem;
        font-family: var(--base-font-family);
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-outline:hover {
        background-color: var(--btn-outline-border-color);
        color: white;
    }

    .btn-flat {
        background-color: var(--btn-flat-bg-color);
        color: var(--btn-flat-text-color);
        border: none;
        border-radius: var(--btn-flat-border-radius);
        padding: 0.75rem 1.5rem;
        font-family: var(--base-font-family);
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-flat:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--btn-gradient-color-1) 0%, var(--btn-gradient-color-2) 50%, var(--btn-gradient-color-3) 100%);
        color: var(--btn-gradient-text-color);
        border: none;
        border-radius: var(--btn-gradient-border-radius);
        padding: 0.75rem 1.5rem;
        font-family: var(--base-font-family);
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }
</style>
