@props([
    'disabled' => false
])

<div class="form-control-wrap">
    <input
        {{ $disabled ??  'disabled'}}
        {{ $attributes->merge(['class' => 'form-control']) }}
    />
</div>
