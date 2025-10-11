@php
    // Obtener configuración del header desde la base de datos
    $headerConfig = null;
    try {
        $config = \App\Models\Config::where('type', 'header')
            ->where('is_active', true)
            ->first();
        if ($config && isset($config->config_data)) {
            $headerConfig = is_array($config->config_data) ? $config->config_data : json_decode($config->config_data, true);
        }
    } catch (\Exception $e) {
        \Log::error('Error loading header config: ' . $e->getMessage());
    }

    // Valores por defecto
    $logoUrl = $headerConfig['logoUrl'] ?? '';
    $backgroundNormal = $headerConfig['backgroundNormal'] ?? 'transparent';
    $backgroundSticky = $headerConfig['backgroundSticky'] ?? '#0a5a39';
    $textColor = $headerConfig['textColor'] ?? '#ffffff';

    // Obtener páginas de navegación
    $navigationPages = \App\Models\Page::with(['publishedChildren' => function($query) {
            $query->orderBy('menu_order');
        }])
        ->where('status', 'published')
        ->where('show_in_nav', true)
        ->whereNull('parent_id')
        ->orderBy('menu_order')
        ->get();
@endphp

<header class="header" style="background-color: {{ $backgroundNormal }}; color: {{ $textColor }};">
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="/" class="brand-link">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="Logo" class="logo-image">
                    @else
                        <h1 class="logo-text" style="color: {{ $textColor }};">RIntegra</h1>
                    @endif
                </a>
            </div>

            <div class="nav-menu" id="navMenu">
                @foreach($navigationPages as $page)
                    <div class="nav-item-wrapper {{ $page->publishedChildren->count() > 0 ? 'has-dropdown' : '' }}">
                        <a href="/{{ $page->slug }}"
                           class="nav-link {{ $page->featured ? 'featured-link' : '' }} {{ $page->publishedChildren->count() > 0 ? 'has-children' : '' }}"
                           style="color: {{ $page->featured ? '#0C6444' : $textColor }};">
                            {{ $page->title }}
                            @if($page->publishedChildren->count() > 0)
                                <span class="dropdown-arrow">▼</span>
                            @endif
                        </a>

                        @if($page->publishedChildren->count() > 0)
                            <div class="dropdown-menu">
                                @foreach($page->publishedChildren as $child)
                                    <a href="/{{ $child->slug }}"
                                       class="nav-link dropdown-link {{ $child->featured ? 'featured-link' : '' }}"
                                       style="color: {{ $child->featured ? '#0C6444' : '#2c3e50' }};">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="nav-toggle" id="navToggle" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
</header>

<style>
.header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1000;
    transition: all 0.3s ease;
    font-family: 'Lato', 'Inter', sans-serif;
}

.header.sticky {
    background-color: {{ $backgroundSticky }} !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar {
    padding: 0;
}

.nav-container {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-brand {
    flex: 0 0 auto;
}

.brand-link {
    text-decoration: none;
    display: flex;
    align-items: center;
}

.logo-image {
    height: 50px;
    width: auto;
    object-fit: contain;
}

.logo-text {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    transition: color 0.3s ease;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.nav-link {
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    opacity: 0.8;
}

.nav-link.featured-link {
    background: linear-gradient(135deg, #c0894f, #ffffaa, #fdfab2, #cb9452) !important;
    color: #0C6444 !important;
    font-weight: bold;
    box-shadow: 0 2px 8px rgba(192, 137, 79, 0.3);
}

.nav-link.featured-link:hover {
    background: linear-gradient(135deg, #b07a42, #f5f59d, #f0f3a5, #b8854a) !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(192, 137, 79, 0.4);
}

.dropdown-arrow {
    font-size: 0.75rem;
    transition: transform 0.3s ease;
}

.nav-item-wrapper.has-dropdown:hover .dropdown-arrow {
    transform: rotate(180deg);
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    min-width: 200px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    padding: 0.5rem 0;
}

.nav-item-wrapper:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-link {
    display: block;
    padding: 0.75rem 1rem !important;
    color: #2c3e50 !important;
    font-size: 0.9rem;
    border-radius: 0;
}

.dropdown-link:hover {
    background-color: #f8f9fa !important;
    color: #007bff !important;
}

.nav-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
    padding: 0.5rem;
}

.nav-toggle span {
    width: 25px;
    height: 3px;
    background-color: {{ $textColor }};
    margin: 3px 0;
    transition: 0.3s;
    border-radius: 2px;
}

@media (max-width: 768px) {
    .nav-container {
        padding: 1rem;
    }

    .nav-toggle {
        display: flex;
    }

    .nav-menu {
        position: fixed;
        top: 70px;
        left: -100%;
        width: 100%;
        height: calc(100vh - 70px);
        background-color: #ffffff;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        padding-top: 2rem;
        gap: 1rem;
        transition: left 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .nav-menu.active {
        left: 0;
    }

    .nav-link {
        font-size: 1.2rem;
        padding: 1rem 2rem;
        width: 80%;
        text-align: center;
        color: #2c3e50 !important;
    }

    .logo-text {
        font-size: 1.5rem;
    }
}
</style>

<script>
// Sticky header on scroll
window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    if (window.scrollY > 0) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});

// Mobile menu toggle
function toggleMobileMenu() {
    const navMenu = document.getElementById('navMenu');
    navMenu.classList.toggle('active');
}
</script>
