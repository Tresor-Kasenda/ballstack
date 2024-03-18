@php
    $label = $getLabel();
    $required = $getRequired();
    $name = $getName();
    $step = $getStep();
    $min = $getMin();
    $max = $getMax();
    $uniqueId = $getUniqueId();
    $placeholder = $getPlaceholder()
@endphp
<div class="form-group" wire:init wire:key="{{ $uniqueId }}">
    @if($label)
        <label class="form-label" for="{{ $uniqueId }}">
            {{ $label }}
        </label>
    @endif
    <div class="form-control-wrap number-spinner-wrap">
        <button
            type="button"
            class="btn btn-icon btn-outline-light number-spinner-btn number-minus"
            data-number="minus">
            <em class="icon ni ni-minus"></em>
        </button>
        <input
            type="number"
            class="form-control number-spinner"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            wire:model="{{ $name }}"
            @if($required) required @endif
            value="{{ old($name) }}"
            placeholder="{{ $placeholder }}"
            @if($step)step="{{ $step }}" @endif
            @if($min) min="{{ $min }}" @endif
            @if($max) max="{{ $max }}" @endif
        >
        <button
            type="button"
            class="btn btn-icon btn-outline-light number-spinner-btn number-plus"
            data-number="plus">
            <em class="icon ni ni-plus"></em>
        </button>
    </div>
</div>
