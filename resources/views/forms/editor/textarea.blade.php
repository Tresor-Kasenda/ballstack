@php
    $name = $getName();
    $required = $getRequired();
    $placeholder = $getPlaceholder();
    $label = $getLabel();
    $rows = $getRows();
    $cols = $getCols();
    $autosize = $isAutosize();
    $readOnly = $isReadonly();
    $length = $getLength();
    $disabled = $isDisabled();
@endphp
<div
    class="form-group"
    @if($autosize)
        x-data="{
            init() {
                this.$refs.textarea.addEventListener('input', this.resize.bind(this))
            },
            resize() {
                this.$refs.textarea.style.height = 'auto'
                this.$refs.textarea.style.height = this.$refs.textarea.scrollHeight + 'px'
            }
        }"
    x-init="init"
    @endif
>
    @if($label)
        <label class="form-label" for="{{ $name }}">Message</label>
    @endif
    <div class="form-control-wrap">
        <textarea
            class="form-control form-control-sm @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            wire:model="{{ $name }}"
            x-ref="textarea"
            rows="{{ $rows }}"
            cols="{{ $cols }}"
            @if($readOnly) readonly @endif
            @if($disabled) disabled @endif
            @if($autosize) x-on:input="resize" @endif
            @if($length) maxlength="{{ $length }}" @endif
        ></textarea>
        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
