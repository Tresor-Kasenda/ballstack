@props([
    'name'
])
<label
    {{ $attributes->merge(['class' => 'form-label']) }}
    for="{{ $name }}"
>
    {{ $slot }}
</label>
