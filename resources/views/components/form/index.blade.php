<form
    enctype="multipart/form-data"
    x-data="{ isUploadingFile: false }"
    x-on:submit="if (isUploadingFile) $event.preventDefault()"
    x-on:file-upload-started="isUploadingFile = true"
    x-on:file-upload-finished="isUploadingFile = false"
    {{ $attributes->merge(['class' => '']) }}
>
    {{ $slot }}
</form>
