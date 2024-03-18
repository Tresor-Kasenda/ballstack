@php
    $name = $getName();
    $checked = $getChecked();
    $label = $getLabel();
    $required = $getRequired();
    $uniqueId = $getUniqueId();
@endphp
<div class="custom-control custom-switch">
    <input
        type="checkbox"
        class="custom-control-input"
        id="{{ $uniqueId }}"
        name="{{ $name }}"
        value="{{ old($name) }}"
        wire:model="{{ $name }}"
        @if($required) required @endif
        @if($checked) checked @endif
    >
    <label
        class="custom-control-label"
        for="{{ $uniqueId }}"
    >{{ $label }}</label>
</div>
