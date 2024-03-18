@php
    $name = $getName();
    $label = $getLabel();
    $required = $getRequired();
    $placeholder = $getPlaceholder();
    $format = $getFormat();
    $minTime = $getMinTime();
    $maxTime = $getMaxTime();
    $datalist = $getDatalist();
@endphp
<div
    class="form-group"
    x-data="{
        init() {
           flatpickr(this.$refs.timePicker, {
                enableTime: true,
                noCalendar: true,
                dateFormat: '{{ $format }}',
                @if($minTime)  minTime: '{{ $minTime }}', @endif
                @if($maxTime)  maxTime: '{{ $maxTime }}', @endif
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('{{ $name }}', dateStr);
                }
           })
       }
    }"
    x-init="init"
>
    @if($label)
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="form-control-wrap">
        <input
            type="text"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name) }}"
            class="form-control @error($name) is-invalid @enderror"
            native="false"
            readonly
            x-ref="timePicker"
            wire:model="{{ $name }}"
            @if($required) required @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            list="{{ $name }}-datalist"
        >
        @if($datalist)
            <datalist id="{{ $name }}-datalist">
                @foreach($datalist as $option)
                    <option value="{{ $option }}">
                @endforeach
            </datalist>
        @endif
        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script data-navigate-track src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
