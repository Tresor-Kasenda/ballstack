<div
    {{ $attributes->merge(['class' => 'nk-block nk-block-lg']) }}
    wire:ignore
>
    {{ $slot }}
</div>
