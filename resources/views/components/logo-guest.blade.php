@props([
    'route',
    'image',
    'alt'
])
<div class="brand-logo pb-5">
    <a href="{{ $route }}" class="logo-link" wire:navigate>
        <img
            class="logo-img logo-img-lg"
            src="{{ $image }}"
            alt="{{ $alt }}">
    </a>
</div>
