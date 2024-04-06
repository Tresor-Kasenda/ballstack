@php
    $label = $getLabel();
@endphp

@props([
    'label' => $label
])
<div
    class="form-group"
    x-data="{
        cropper: null,
        init() {
            this.cropper = new Croppie(this.$refs.croppie, {
                aspectRatio: 1,
                viewMode: 'circle',
                prev: '',
                width: 100,
                height: 100,
            }),
        },
    }"
    wire:ignore
>
    @if($label)
        <label class="form-label" for="{{ $getName() }}">{{ $label }}</label>
    @endif

    <div class="form-control-wrap ">
        <input
            type="file"
            class="border round-xl"
            id="{{ $getName() }}"
            name="{{ $getName() }}"
            x-ref="croppie"
            x-on:change="updatePreview()"
        >
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css"
          integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg=="
          crossorigin="anonymous" media="print" onload="this.media='all'"/>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"
            integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig=="
            crossorigin="anonymous"></script>
@endpush
