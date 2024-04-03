@php
    $name = $getName();
    $label = $getLabel();
    $required = $getRequired();
    $tooltip = $getTooltip();
    $checked = $getChecked();
    $uniqueId = $getUniqueId();
@endphp

<div class="custom-control custom-checkbox">
    <input
        type="checkbox"
        class="custom-control-input"
        id="{{ $uniqueId }}"
        name="{{ $name }}"
        wire:model="{{ $name }}"
        @if($required) required @endif
        @if($checked) checked @endif
    >
    <label class="custom-control-label custom-label" for="{{ $uniqueId }}" title="{{ $tooltip }}">
        {{ $label }}
    </label>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
