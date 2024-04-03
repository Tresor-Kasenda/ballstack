@php
    $name = $getName();
    $label = $getLabel();
    $required = $getRequired();
    $multiple = $getMultiple();
    $reorder = $getReorder();
    $fileSize = $getFileSize();
    $accepts = $getAccepts();
@endphp
<div
    class="form-group"
    wire:ignore
    x-data="{
        initFilePond() {
            @if($isAllowFileSizeValidation())
                FilePond.registerPlugin(FilePondPluginFileValidateSize);
            @endif
            @if($isAllowFileTypeValidation())
                FilePond.registerPlugin(FilePondPluginFileValidateType);
            @endif
            @if($getAllowImageCrop())
                FilePond.registerPlugin(FilePondPluginImageCrop);
            @endif
            @if($getAllowImagePreview())
                FilePond.registerPlugin(FilePondPluginImagePreview);
            @endif
            const input = this.$refs.input;
            const pond = FilePond.create(input);
            pond.setOptions({
                @if($multiple) allowMultiple: true, @endif
                labelIdle: `Drag & Drop your picture or Browse`,
                acceptedFileTypes: ['@js($accepts)'],
                @if($required) required: true, @endif
                @if($getDropped()) allowDrop: true, @endif
                @if($reorder) allowReorder: true,@endif
                @if($fileSize) maxFileSize:'@js($fileSize)', @endif
                @if($getAllowRevert()) allowRevert: true, @endif
                @if($getAllowImagePreview()) allowImagePreview: true, @endif
                @if($isAllowFileSizeValidation()) allowFileSizeValidation: true, @endif
                @if($isAllowFileTypeValidation()) allowFileTypeValidation: true, @endif
                @if($getMaxParallelUploads()) maxParallelUploads: @js($getMaxParallelUploads()), @endif
                @if($getAllowRemove()) allowRemove: true, @endif
                @if($getAllowImageCrop()) allowImageCrop: true, @endif
                @if($getAllowProcess()) allowProcess: true, @endif
                @if($getFileSizeBase()) fileSizeBase: @js($getFileSizeBase()), @endif
                credits:{},
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('{{ $name }}', file, load, error, progress);
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('{{ $name }}', filename, load);
                    }
                },
            });
        }
    }"
    x-init="initFilePond"
>
    @if($label)
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="form-control-wrap ">
        <input
            type="file"
            class="border round-xl"
            id="{{ $name }}"
            name="{{ $name }}"
            x-ref="input"
            @if($required) required @endif
            wire:model="{{ $name }}"
            @if($multiple) multiple @endif
            @if($reorder)data-allow-reorder="true" @endif
            @if($fileSize)data-max-file-size="{{ $fileSize }}" @endif
        >
    </div>
</div>

@push('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
@endpush

@push('scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endpush

