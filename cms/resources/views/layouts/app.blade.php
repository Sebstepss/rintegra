<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $page->seo_title ?? $page->title ?? 'R-Integra')</title>
    <meta name="description" content="@yield('description', $page->seo_description ?? '')">
    
    <!-- SEO Meta Tags -->
    <meta property="og:title" content="@yield('title', $page->title ?? 'R-Integra')">
    <meta property="og:description" content="@yield('description', $page->seo_description ?? '')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    @if(isset($page->featured_image))
    <meta property="og:image" content="{{ asset('storage/' . $page->featured_image) }}">
    @endif
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Load fonts asynchronously -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" 
          rel="stylesheet" 
          media="print" 
          onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" 
              rel="stylesheet">
    </noscript>
    
    <!-- Public CSS -->
    @vite(['resources/css/public.css'])
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        @if(isset($siteConfig) && $siteConfig->header_config)
            @php
                $headerConfig = json_decode($siteConfig->header_config, true);
            @endphp
            
            <nav class="main-nav">
                @if(isset($headerConfig['logo']))
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            @if(isset($headerConfig['logo']['image']))
                                <img src="{{ asset('storage/' . $headerConfig['logo']['image']) }}" 
                                     alt="{{ $headerConfig['logo']['text'] ?? 'R-Integra' }}"
                                     loading="lazy">
                            @else
                                <h1>{{ $headerConfig['logo']['text'] ?? 'R-Integra' }}</h1>
                            @endif
                        </a>
                    </div>
                @endif
                
                @if(isset($headerConfig['navigation']))
                    <ul class="nav-menu">
                        @foreach($headerConfig['navigation'] as $navItem)
                            <li>
                                <a href="{{ $navItem['url'] ?? '#' }}">
                                    {{ $navItem['label'] ?? '' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </nav>
        @else
            <!-- Default header -->
            <nav class="main-nav">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <h1>R-Integra</h1>
                    </a>
                </div>
            </nav>
        @endif
    </header>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        @if(isset($siteConfig) && $siteConfig->footer_config)
            @php
                $footerConfig = json_decode($siteConfig->footer_config, true);
            @endphp
            
            {!! $footerConfig['content'] ?? '' !!}
        @else
            <!-- Default footer -->
            <div class="footer-content">
                <p>&copy; {{ date('Y') }} R-Integra. Todos los derechos reservados.</p>
            </div>
        @endif
    </footer>

    <!-- Public JS -->
    @vite(['resources/js/public.js'])
    
    @stack('scripts')
</body>
</html>