@props([
    'value',
    'name'
])
<div class="form-label-group">
    <label
        class="form-label"
        for="{{ $name }}"
    >
        {{ $value ?? $slot }}
    </label>
</div>
