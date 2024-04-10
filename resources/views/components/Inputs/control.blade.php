<div
    {{ $attributes->merge(['class' => 'form-group']) }}
    wire:ignore
>
    {{ $slot }}
</div>
