@php
    $label = $getLabel();
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
    $uniqueId = $getUniqueId();
    $prefix = $getPrefix();
@endphp

<div class="form-group">
    @if($label)
        <label class="form-label" for="{{ $uniqueId }}">{{ $label }}</label>
    @endif
    
    <div class="form-control-wrap">
        <div class="input-group">
            @if($getPosition() === 'left')
                @if($prefix)
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="{{ $uniqueId }}">
                            <em class="icon ni ni-{{ $prefix }}"></em>
                        </span>
                    </div>
                @endif
                <input
                    type="{{ $type }}"
                    class="form-control @error($name) is-invalid @enderror"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}"
                    @if($required) required @endif
                    @if($placeholder)placeholder="{{ $placeholder }}" @endif
                    @if($minlength) minlength="{{ $minlength }}" @endif
                    @if($maxlength)maxlength="{{ $maxlength }}" @endif
                    @if($pattern)pattern="{{ $pattern }}" @endif
                    @if($readOnly)readonly @endif
                    @if($disable)disabled @endif
                    @if($step)step="{{ $step }}" @endif
                    @if($autocomplete)autocomplete="" @endif
                    @if($autofocus) autofocus @endif
                    wire:model="{{ $name }}"
                >
            @elseif($getPosition() === 'right')
                <input
                    type="{{ $type }}"
                    class="form-control @error($name) is-invalid @enderror"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}"
                    @if($required) required @endif
                    @if($placeholder)placeholder="{{ $placeholder }}" @endif
                    @if($minlength) minlength="{{ $minlength }}" @endif
                    @if($maxlength)maxlength="{{ $maxlength }}" @endif
                    @if($pattern)pattern="{{ $pattern }}" @endif
                    @if($readOnly)readonly @endif
                    @if($disable)disabled @endif
                    @if($step)step="{{ $step }}" @endif
                    @if($autocomplete)autocomplete="" @endif
                    @if($autofocus) autofocus @endif
                    wire:model="{{ $name }}"
                >
                @if($prefix)
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="{{ $uniqueId }}">
                            <em class="icon ni ni-{{ $prefix }}"></em>
                        </span>
                    </div>
                @endif
            @else
                <input
                    type="{{ $type }}"
                    class="form-control @error($name) is-invalid @enderror"
                    id="{{ $uniqueId }}"
                    name="{{ $name }}"
                    @if($required) required @endif
                    @if($placeholder)placeholder="{{ $placeholder }}" @endif
                    @if($minlength) minlength="{{ $minlength }}" @endif
                    @if($maxlength)maxlength="{{ $maxlength }}" @endif
                    @if($pattern)pattern="{{ $pattern }}" @endif
                    @if($readOnly)readonly @endif
                    @if($disable)disabled @endif
                    @if($step)step="{{ $step }}" @endif
                    @if($autocomplete)autocomplete="" @endif
                    @if($autofocus) autofocus @endif
                    wire:model="{{ $name }}"
                >
            @endif
        </div>

        @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        @if($helpText)
            <small class="form-text text-muted">{{ $helpText }}</small>
        @endif
    </div>
</div>
