<div class="team-block-content">
    @if(isset($block['data']['title']))
        <h2 class="team-title">{{ $block['data']['title'] }}</h2>
    @endif
    
    @if(isset($block['data']['members']) && is_array($block['data']['members']))
        <div class="team-grid">
            @foreach($block['data']['members'] as $member)
                <div class="team-member">
                    @if(isset($member['image']))
                        <div class="member-image">
                            <img src="{{ $member['image'] }}" 
                                 alt="{{ $member['name'] ?? 'Team member' }}"
                                 loading="lazy">
                        </div>
                    @endif
                    
                    @if(isset($member['name']))
                        <h3 class="member-name">{{ $member['name'] }}</h3>
                    @endif
                    
                    @if(isset($member['position']))
                        <p class="member-position">{{ $member['position'] }}</p>
                    @endif
                    
                    @if(isset($member['bio']))
                        <p class="member-bio">{{ $member['bio'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>