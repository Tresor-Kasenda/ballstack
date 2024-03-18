@php
    $name = $getName();
    $label = $getLabel();
    $options = $getOptions();
    $checked = $getChecked();
    $inline = $isInline();
@endphp

<div>
    @if($label)
        <span class="h-25 title fw-medium">{{ $label }}</span>
    @endif
    @foreach($options as $value => $option)
        <div class="custom-control custom-radio {{ $inline ? 'd-inline-block' : '' }}">
            <input
                type="radio"
                id="{{ $name }}_{{ $value }}"
                name="{{ $name }}"
                value="{{ $value }}"
                class="custom-control-input"
                {{ $value == $checked ? 'checked' : '' }}
                wire:model.live="{{ $name }}"
            >
            <label class="custom-control-label"
                   for="{{ $name }}_{{ $value }}"
            >{{ $option }}</label>
        </div>
        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    @endforeach
</div>
