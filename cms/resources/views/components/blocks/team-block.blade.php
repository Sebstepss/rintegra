@php
    $members = $block['members'] ?? [];
    $columnsCount = $block['columnsCount'] ?? 3;
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
    $padding = $block['padding'] ?? 'medium';
    $gap = $block['gap'] ?? 'medium';
    $alignment = $block['alignment'] ?? 'center';
    $hoverEffect = $block['hoverEffect'] ?? 'none';
    $aspectRatio = $block['aspectRatio'] ?? 'square';
    $maskType = $block['maskType'] ?? 'none';
    $borderRadius = $block['borderRadius'] ?? 12;

    // Mapeo de valores
    $paddingMap = ['none' => '0', 'small' => '1rem 0', 'medium' => '2rem 0', 'large' => '3rem 0'];
    $paddingValue = $paddingMap[$padding] ?? '2rem 0';

    $gapMap = ['none' => '0', 'small' => '0.5rem', 'medium' => '1rem', 'large' => '2rem'];
    $gapValue = $gapMap[$gap] ?? '1rem';

    // Mapeo de iconos sociales
    $socialSymbols = [
        'facebook' => 'f',
        'twitter' => '𝕏',
        'instagram' => '📷',
        'linkedin' => 'in',
        'github' => '🐙',
    ];

    // Función para construir URL de medios (replica buildMediaUrl de Vue)
    if (!function_exists('buildMediaUrl')) {
        function buildMediaUrl($url) {
            if (empty($url)) return '';

            // Si es URL completa, devolverla tal cual
            if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
                return $url;
            }

            // Si contiene 'storage/', extraer la parte después de 'storage/'
            if (str_contains($url, 'storage/')) {
                $parts = explode('storage/', $url);
                $storagePath = end($parts);
                return asset('storage/' . $storagePath);
            }

            // Para otras URLs, usar asset directamente
            return asset($url);
        }
    }
@endphp

<div
    class="team-block team-columns-{{ $columnsCount }} team-gap-{{ $gap }} team-padding-{{ $padding }} team-align-{{ $alignment }} team-hover-{{ $hoverEffect }}"
    style="background-color: {{ $backgroundColor }}; padding: {{ $paddingValue }}; width: 100%; overflow: visible;"
>
    <div class="team-container">
        @if(count($members) > 0)
            <div class="team-grid" style="--team-gap: {{ $gapValue }};">
                @foreach($members as $member)
                    <div class="team-member team-aspect-{{ $aspectRatio }} team-mask-{{ $maskType }}"
                         @if($maskType === 'rounded')
                         style="border-radius: {{ $borderRadius }}px;"
                         @endif
                    >
                        <div class="member-card">
                            <div class="member-photo-container">
                                @if(!empty($member['photo']))
                                    <img
                                        src="{{ buildMediaUrl($member['photo']) }}"
                                        alt="{{ $member['name'] ?? 'Team member' }}"
                                        class="member-photo"
                                        loading="lazy"
                                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNiIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9IjAuM2VtIj5TaW4gZm90bzwvdGV4dD48L3N2Zz4=';"
                                    >
                                @else
                                    <div class="member-photo-placeholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                        <span>Sin foto</span>
                                    </div>
                                @endif

                                <!-- Overlay con información básica -->
                                <div class="member-overlay">
                                    @if(!empty($member['name']))
                                        <h3 class="member-name">{{ $member['name'] }}</h3>
                                    @endif
                                    @if(!empty($member['position']))
                                        <p class="member-position">{{ $member['position'] }}</p>
                                    @endif

                                    <!-- Redes sociales -->
                                    @if(!empty($member['socials']) && is_array($member['socials']) && count($member['socials']) > 0)
                                        <div class="member-socials">
                                            @foreach($member['socials'] as $social)
                                                @if(!empty($social['url']))
                                                    @php
                                                        $platform = $social['platform'] ?? 'website';
                                                        $url = $platform === 'email' && !str_starts_with($social['url'], 'mailto:')
                                                            ? 'mailto:' . $social['url']
                                                            : $social['url'];
                                                        $symbol = $socialSymbols[$platform] ?? '🔗';
                                                    @endphp
                                                    <a
                                                        href="{{ $url }}"
                                                        class="social-link social-{{ $platform }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        title="{{ $member['name'] }} - {{ ucfirst($platform) }}"
                                                    >
                                                        <span class="social-symbol">{{ $symbol }}</span>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Descripción que aparece en hover -->
                            @if(!empty($member['description']) && trim($member['description']))
                                <div class="member-description">
                                    <div class="description-content">
                                        <p>{{ $member['description'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="team-empty">
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <h4>Equipo Vacío</h4>
                    <p>Este equipo no tiene miembros aún</p>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* Team Block Base */
.team-block {
    width: 100%;
    overflow: visible;
}

.team-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.team-grid {
    display: grid;
    width: 100%;
    gap: var(--team-gap);
}

/* Configuración de columnas */
.team-columns-1 .team-grid { grid-template-columns: 1fr; }
.team-columns-2 .team-grid { grid-template-columns: repeat(2, 1fr); }
.team-columns-3 .team-grid { grid-template-columns: repeat(3, 1fr); }
.team-columns-4 .team-grid { grid-template-columns: repeat(4, 1fr); }
.team-columns-5 .team-grid { grid-template-columns: repeat(5, 1fr); }
.team-columns-6 .team-grid { grid-template-columns: repeat(6, 1fr); }

/* Alineación */
.team-align-left .team-container { margin-left: 0; margin-right: auto; }
.team-align-center .team-container { margin-left: auto; margin-right: auto; }
.team-align-right .team-container { margin-left: auto; margin-right: 0; }

/* Elementos del equipo */
.team-member {
    position: relative;
    overflow: hidden;
    background: #f8f9fa;
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.member-card {
    position: relative;
    width: 100%;
    height: 100%;
}

.member-photo-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    border-radius: inherit;
}

.member-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease, filter 0.3s ease;
    display: block;
}

.member-photo-placeholder {
    width: 100%;
    height: 100%;
    background: #f8f9fa;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    text-align: center;
    border-radius: inherit;
}

.member-photo-placeholder span {
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

/* Overlay con información básica */
.member-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: white;
    padding: 2rem 1rem 1rem;
    text-align: center;
    transform: translateY(0);
    transition: all 0.3s ease;
}

.member-name {
    margin: 0 0 0.25rem 0;
    font-size: 1.1rem;
    font-weight: 600;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}

.member-position {
    margin: 0 0 0.75rem 0;
    font-size: 0.9rem;
    opacity: 0.9;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

.member-socials {
    display: flex;
    justify-content: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.social-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.social-symbol {
    font-weight: bold;
    font-size: 1rem;
    color: inherit;
}

/* Estilos específicos por plataforma */
.social-facebook:hover { background: rgba(24, 119, 242, 0.8); }
.social-twitter:hover { background: rgba(0, 0, 0, 0.8); }
.social-instagram:hover { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
.social-linkedin:hover { background: rgba(0, 119, 181, 0.8); }
.social-github:hover { background: rgba(51, 51, 51, 0.8); }

/* Descripción que aparece en hover */
.member-description {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    border-radius: inherit;
    z-index: 10;
}

.description-content {
    max-width: 100%;
    max-height: 100%;
    overflow-y: auto;
}

.member-description p {
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.5;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}

/* Hover effects */
.team-member:hover .member-description {
    opacity: 1;
    transform: translateY(0);
    visibility: visible;
}

.team-member:hover .member-photo {
    transform: scale(1.05);
}

.team-hover-zoom .team-member:hover .member-photo {
    transform: scale(1.1);
}

.team-hover-fade .team-member:hover .member-photo {
    filter: brightness(0.7);
}

.team-hover-lift .team-member:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

/* Relaciones de aspecto */
.team-aspect-square { aspect-ratio: 1 / 1; }
.team-aspect-4-3 { aspect-ratio: 4 / 3; }
.team-aspect-16-9 { aspect-ratio: 16 / 9; }
.team-aspect-3-4 { aspect-ratio: 3 / 4; }
.team-aspect-9-16 { aspect-ratio: 9 / 16; }
.team-aspect-auto { aspect-ratio: auto; height: auto; min-height: 300px; }

/* Máscaras */
.team-mask-circle .member-photo { clip-path: circle(50%); }
.team-mask-circle .member-photo-container { border-radius: 50%; }
.team-mask-rounded .member-photo { border-radius: inherit; }

/* Estado vacío */
.team-empty {
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-state {
    text-align: center;
    color: #6c757d;
    padding: 2rem;
}

.empty-state svg {
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h4 {
    margin: 0 0 0.5rem 0;
    color: #495057;
    font-size: 1.5rem;
}

.empty-state p {
    margin: 0;
    font-size: 1rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .team-columns-6 .team-grid,
    .team-columns-5 .team-grid { grid-template-columns: repeat(3, 1fr); }
    .team-columns-4 .team-grid { grid-template-columns: repeat(2, 1fr); }

    .member-overlay { padding: 1.5rem 0.75rem 0.75rem; }
    .member-name { font-size: 1rem; }
    .member-position { font-size: 0.85rem; }
    .social-link { width: 32px; height: 32px; }
}

@media (max-width: 768px) {
    .team-columns-6 .team-grid,
    .team-columns-5 .team-grid,
    .team-columns-4 .team-grid,
    .team-columns-3 .team-grid { grid-template-columns: repeat(2, 1fr); }

    .member-overlay { padding: 1rem 0.5rem 0.5rem; }
    .member-name { font-size: 0.95rem; }
    .member-position { font-size: 0.8rem; margin-bottom: 0.5rem; }
    .member-socials { gap: 0.5rem; }
    .social-link { width: 28px; height: 28px; }
    .member-description { padding: 1rem; }
    .member-description p { font-size: 0.9rem; }
}

@media (max-width: 480px) {
    .team-grid { grid-template-columns: 1fr !important; }
    .team-container { padding: 0 0.5rem; }

    .member-overlay { padding: 0.75rem 0.5rem 0.5rem; }
    .member-name { font-size: 0.9rem; }
    .member-position { font-size: 0.75rem; }
    .social-link { width: 26px; height: 26px; }
    .member-description { padding: 0.75rem; }
    .member-description p { font-size: 0.85rem; }
    .team-aspect-auto { min-height: 250px; }
}
</style>
