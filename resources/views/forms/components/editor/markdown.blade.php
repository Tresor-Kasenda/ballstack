@php
    $name = $getName();
    $label = $getLabel();
    $uniqueId = $getUniqueId();
    $placeholder = $getPlaceholder();
    $height = $getHeight();
@endphp
<div
    class="form-group"
    x-data="{
        initEasy() {
            const simpleMDE = new SimpleMDE({
                element: this.$refs.editor,
                minHeight: '{{$height}}px',
                placeholder: '{{ $placeholder }}',
                autosave: {
                    enabled: true,
                    uniqueId: '{{$name}}-{{ $uniqueId }}',
                    delay: 1000,
                    submit_delay: 5000,
                    timeFormat: {
                        locale: 'en-US',
                        format: {
                            year: 'numeric',
                            month: 'long',
                            day: '2-digit',
                            hour: '2-digit',
                            minute: '2-digit',
                        },
                    },
                    forceSync: true,
                    text: 'Autosaved: ',
                    hideIcons: ['guide', 'heading'],
                },
            });
            simpleMDE.codemirror.on('inputRead', function(){
                @this.set('{{$name}}', simpleMDE.value());
            });
        }
    }"
    x-init="initEasy"
>
    @if($label)
        <label class="form-label" for="{{ $uniqueId }}">{{ $label }}</label>
    @endif
    <div class="form-control-wrap">
        <textarea
            x-ref="editor"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            wire:model="{{$name}}"
        ></textarea>
    </div>
</div>

@push('styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
@endpush
