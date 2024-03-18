@php
    $route = $getRoute();
    $items = $getItems();
    $icon = $getIcon();
    $name = $getName();
@endphp

<div class="nk-sidebar nk-sidebar-fixed is-{{ $getTheme() ?? 'white' }} " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ $route }}" class="logo-link nk-sidebar-logo" wire:navigate>
                <img class="logo-light logo-img" src="{{ $getLogo() }}" srcset="{{ $getLogo() }} 2x" alt="{{ $name }}">
                <img class="logo-dark logo-img" src="{{ $getLogo() }}" srcset="{{ $getLogo() }} 2x" alt="{{ $name }}">
                <img class="logo-small logo-img logo-img-small" src="{{ $getLogo() }}" srcset="{{ $getLogo() }} 2x"
                     alt="{{ $name }}">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-{{ $icon }}"></em>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">{{ $name }}</h6>
                    </li>
                    @foreach($items as $item)
                        {{ $item }}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
