@php
    $name = $getName();
    $placeholder = $getPlaceholder();
    $options = $getOptions();
    $theme = $getTheme();
@endphp
<div
    class="card"
    x-data="{
        initQuill() {
            this.quill = new Quill(this.$refs.editor, {
                theme: '{{ $theme }}',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'script': 'sub' }, { 'script': 'super' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'header': [1, 2, 3, 4, 5, 6] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                    ],
                },
                placeholder: '{{ $placeholder }}',
            });
            this.quill.on('editor-change', function(data) {
                this.$refs.editor.value = data;
                this.$refs.editor.dispatchEvent(new Event('input'))
                @this.set('{{ $name }}', quill.root.innerHTML, false);
            });
        },
    }"
    x-init="initQuill"
>
    <div class="card-inner">
        <div
            x-ref="editor"
            wire:model="{{ $name }}"
        ></div>
    </div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet"/>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
@endpush

