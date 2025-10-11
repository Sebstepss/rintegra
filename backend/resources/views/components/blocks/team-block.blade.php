@php
    $title = $block['title'] ?? '';
    $members = $block['members'] ?? [];
    $columnsCount = $block['columnsCount'] ?? 3;
    $backgroundColor = $block['backgroundColor'] ?? 'transparent';
    $padding = $block['padding'] ?? 'medium';

    $paddingMap = ['none' => '0', 'small' => '2rem', 'medium' => '4rem', 'large' => '6rem'];
    $paddingValue = $paddingMap[$padding] ?? '4rem';
@endphp

<div class="team-block-content" style="background-color: {{ $backgroundColor }}; padding: {{ $paddingValue }};">
    <div class="team-container" style="max-width: 1400px; margin: 0 auto;">
        @if($title)
            <h2 class="team-title" style="text-align: center; font-size: 2rem; font-weight: 600; margin-bottom: 3rem; color: #2c3e50;">
                {{ $title }}
            </h2>
        @endif

        @if(count($members) > 0)
            <div class="team-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                @foreach($members as $member)
                    <div class="team-member" style="text-align: center; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s;">
                        @if(!empty($member['image']))
                            <div class="member-image" style="margin-bottom: 1.5rem;">
                                <img src="{{ $member['image'] }}"
                                     alt="{{ $member['name'] ?? 'Team member' }}"
                                     loading="lazy"
                                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin: 0 auto; display: block;">
                            </div>
                        @endif

                        @if(!empty($member['name']))
                            <h3 class="member-name" style="font-size: 1.3rem; font-weight: 600; margin-bottom: 0.5rem; color: #2c3e50;">
                                {{ $member['name'] }}
                            </h3>
                        @endif

                        @if(!empty($member['position']))
                            <p class="member-position" style="color: #0a5a39; font-weight: 500; margin-bottom: 1rem;">
                                {{ $member['position'] }}
                            </p>
                        @endif

                        @if(!empty($member['bio']))
                            <p class="member-bio" style="color: #6c757d; line-height: 1.6; margin: 0;">
                                {{ $member['bio'] }}
                            </p>
                        @endif

                        @if(!empty($member['socialLinks']) && is_array($member['socialLinks']))
                            <div class="member-social" style="display: flex; justify-content: center; gap: 1rem; margin-top: 1.5rem;">
                                @foreach($member['socialLinks'] as $social)
                                    @if(!empty($social['url']))
                                        <a href="{{ $social['url'] }}" target="_blank" style="color: #0a5a39; font-size: 1.2rem; transition: opacity 0.3s;">
                                            <i class="{{ $social['icon'] ?? 'fas fa-link' }}"></i>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .team-member:hover {
        transform: translateY(-5px);
    }

    .member-social a:hover {
        opacity: 0.7;
    }

    @media (max-width: 768px) {
        .team-block-content {
            padding: 2rem 1rem !important;
        }

        .team-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
