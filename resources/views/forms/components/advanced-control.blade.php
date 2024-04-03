@php
    $name = $getName();
    $label = $getLabel();
    $required = $getRequired();
    $mode = $getMode();
    $disabled = $isDisabled();
    $options = $getOptions();
    $icons = $getIcons(); // Get the icons
@endphp

<div class="card card-preview">
    <div class="card-inner">
        @if($label)
            <h6 class="title  mb-3">{{ $label }}</h6>
        @endif
        @if($getDescription())
            <p class="text-base">{{ $getDescription() }}</p>
        @endif
        <ul class="custom-control-group">
            @foreach($options as $key => $value)
                <li wire:key="{{ $key }}">
                    <div
                        class="custom-control
                        {{ $isMultiple() ? 'custom-checkbox' : 'custom-radio' }}
                         custom-control-pro
                         @if($value == 'checked') checked @endif
                         {{ $mode === 'control' ? 'no-control' : 'custom-control-sm' }}"
                    >
                        <input
                            type="{{ $isMultiple() ? 'checkbox' : 'radio' }}"
                            class="custom-control-input @error($name) is-invalid @enderror"
                            name="{{ $name }}-{{$key}}"
                            @if($disabled) disabled @endif
                            id="{{ $name }}-{{$key}}"
                            wire:model="{{ $name }}"
                        >
                        @if($label)
                            <label class="custom-control-label" for="{{ $name }}-{{$key}}">
                                @if(isset($icons[$value]))
                                    <em class="icon ni ni-{{ $icons[$value] }}"></em>
                                @endif
                                <span>{{ $value }}</span>
                            </label>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
