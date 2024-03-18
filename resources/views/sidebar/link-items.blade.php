@php
    $name = $getName();
    $icon = $getIcon();
    $route = $getRoute();
    $children = $getChildren();
@endphp
<li class="nk-menu-item {{ $children ? 'has-sub' : '' }}">
    <a
        href="{{ $route ?? "#" }}"
        @if(! $children)
            wire:navigate
        @endif
        class="nk-menu-link {{ request()->routeIs($route) ? 'active current-page' : '' }} {{ $children ? ' nk-menu-toggle' : '' }}">
        <span class="nk-menu-icon">
            <em class="icon ni ni-{{ $icon }}"></em>
        </span>
        <span class="nk-menu-text">{{ $name }}</span>
    </a>
    @if($children)
        <ul class="nk-menu-sub">
            @foreach($children as $child)
                <li class="nk-menu-item">
                    <a
                        href="{{ $child->route }}"
                        wire:navigate
                        class="nk-menu-link {{ request()->routeIs($child->route) ? 'active current-page' : '' }}">
                        <span class="nk-menu-text">{{ $child->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
