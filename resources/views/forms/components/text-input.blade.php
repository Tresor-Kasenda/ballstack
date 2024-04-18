@php
    $name = $getName();
    $required = $getRequired();
    $placeholder = $getPlaceholder();
    $minlength = $getMinLength();
    $autofocus = $getAutofocus();
    $maxlength = $getMaxLength();
    $pattern = $getPattern();
    $helpText = $getHelpText();
    $readOnly = $getReadOnly();
    $step = $getStep();
    $autocomplete = $getAutocomplete();
    $type = $getType();
    $disable = $isDisabled();
    $prefix = $getPrefix();
@endphp

@props([
    'type' => $type,
    'length' => $length = 'lg' ? 'form-control-lg' : 'form-control-sm'
])
<x-ballstack::Inputs.control>
    @if($getLabel())
        <x-ballstack::Inputs.label :name="$getUniqueId()">
            {{ $getLabel() }}
        </x-ballstack::Inputs.label>
    @endif
    <div class="form-control-wrap">
        <div class="input-group">
            <input
                type="{{ $type }}"
                class="form-control @error($name) is-invalid @enderror"
                id="{{ $getUniqueId() }}"
                name="{{ $name }}"
                @if($required) required @endif
                @if($placeholder)placeholder="{{ $placeholder }}" @endif
                @if($minlength) minlength="{{ $minlength }}" @endif
                @if($maxlength)maxlength="{{ $maxlength }}" @endif
                @if($pattern)pattern="{{ $pattern }}" @endif
                @if($readOnly)readonly @endif
                @if($disable)disabled @endif
                @if($step)step="{{ $step }}" @endif
                @if($autocomplete)autocomplete="true" @endif
                @if($autofocus) autofocus @endif
                wire:model.live="{{ $name }}"
            >
            @if($prefix)
                <div class="input-group-append">
                    <span class="input-group-text" id="{{ $getUniqueId() }}">{{ $prefix }}</span>
                </div>
            @endif
        </div>

        @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        @if($helpText)
            <small class="form-text text-muted">{{ $helpText }}</small>
        @endif
    </div>
</x-ballstack::Inputs.control>
