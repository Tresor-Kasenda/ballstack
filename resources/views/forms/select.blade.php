@php
    $name = $getName();
    $label = $getLabel();
    $options = $getOptions();
    $native = $getNative();
    $searchable = $getSearchable();
    $multiple = $getMultiple();
    $require = $getRequired();
    $placeholder = $getPlaceholder();
    $autofocus = $getAutofocus();
    $uniqueId = $getUniqueId();
    $live = $getLive();
@endphp

<div class="form-group" wire:key="{{$uniqueId }}">
    @if($label)
        <label class="form-label" for="{{ $uniqueId  }}">{{ $label }}</label>
    @endif
    <div class="form-control-wrap">
        <select
            class="form-select js-select2"
            @if($searchable) data-search="on" @endif
            @if($multiple) multiple="multiple" @endif
            @if($placeholder)data-placeholder="{{ $placeholder }}" @endif
            @if($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
            wire:change="{{ $name }}"
            id="{{ $uniqueId  }}"
            name="{{ $name }}"
            @if($autofocus) autofocus @endif
            autocomplete="{{ $getAutocomplete() ? 'on' : 'off' }}"
            @if($isDisabled()) disabled @endif
        >
            <option disabled>{{ $placeholder }}</option>
            @foreach($options as $key => $value)
                @if(is_array($value))
                    <optgroup label="{{ $key }}">
                        @foreach($value as $subKey => $subValue)
                            <option
                                value="{{ $subKey }}"
                                @if($subKey == old($name, $name)) selected @endif
                            >{{ $subValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option
                        value="{{ $key }}"
                        @if($key == old($name, $name)) selected @endif
                    >{{ $value }}</option>
                @endif
            @endforeach
        </select>
        @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
