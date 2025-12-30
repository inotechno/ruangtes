@if($menu->is_title)
    <li class="menu-title" key="t-{{ $menu->key }}">
        {{ $menu->name }}
    </li>
@else
    <li>
        <a href="{{ $menu->formatted_url }}"
           class="{{ $menu->children->isNotEmpty() ? 'has-arrow waves-effect' : 'waves-effect' }}">
            
            @if($menu->icon)
                <i class="{{ $menu->icon }}"></i>
            @endif

            <span key="t-{{ $menu->key }}">{{ $menu->name }}</span>

            @if($menu->badge)
                <span class="badge bg-{{ $menu->badge_color ?? 'primary' }}">
                    {{ $menu->badge }}
                </span>
            @endif
        </a>

        @if($menu->children->isNotEmpty())
            <ul class="sub-menu" aria-expanded="false">
                @foreach($menu->children as $child)
                    <x-menu-item :menu="$child"/>
                @endforeach
            </ul>
        @endif
    </li>
@endif
