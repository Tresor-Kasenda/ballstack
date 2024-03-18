<div
    class="form-group"
    x-data="{
        init() {
            ClassicEditor
                .create(document.querySelector(this.$refs.editor), {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'outdent',
                            'indent',
                            '|',
                            'blockQuote',
                            'insertTable',
                            'mediaEmbed',
                            'undo',
                            'redo'
                        ],
                        shouldNotGroupWhenFull: true
                    }
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('{{ $attributes['wire:model'] }}', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }"
    x-init="init"
>
    <label class="form-label" for="">Message</label>
    <div class="form-control-wrap">
        <div
            id="editor"
            x-ref="editor"
            wire:model="editor"
        ></div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endpush
