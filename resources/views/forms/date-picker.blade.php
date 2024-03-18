@php
    $name = $getName();
    $label = $getLabel();
    $minDate = $getMinDate();
    $maxDate = $getMaxDate();
    $dateFormat = $getFormat();
    $required = $getRequired();
    $enableTime = $getEnableTime();
    $mode = $getMode();
    $placeholder = $getPlaceholder();
    $disabled = $getDisable();
@endphp
<div
    class="form-group"
    x-data="{
        init() {
           flatpickr(this.$refs.dateTimePicker, {
              @if($enableTime)enableTime: true, @endif
              dataFormat: '{{ $dateFormat }}',
              @if($minDate)minDate: '{{ $minDate }}', @endif
              @if($maxDate)maxDate: '{{ $maxDate }}', @endif
              @if($disabled)
                 disable: [
                    @foreach($disabled as $disable)
                        '{{ $disable }}',
                    @endforeach
                 ],
              @endif
              @if($mode)mode: '{{ $mode }}', @endif
                onChange: function(selectedDates, dateStr, instance) {
                    @this.set('{{ $name }}', dateStr, false);
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
            x-ref="dateTimePicker"
            wire:model="{{ $name }}"
            @if($required) required @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
        >
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
