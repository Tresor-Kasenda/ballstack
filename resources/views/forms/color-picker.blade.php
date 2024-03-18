<div
    class="custom-control"
    x-data="{
        initColorPicker() {
            this.colorPicker = new iro.ColorPicker(this.$refs.input, {
                @if($getWidth()) width: {{ $getWidth() }}, @endif
                color: '#f00',
            });
            this.colorPicker.on('color:change', (color) => {
                this.$refs.input.value = color.{{$getType()}}String;
                this.$refs.input.dispatchEvent(new Event('input'));
            });
        }
    }"
    x-init="initColorPicker"
>
    <div
        wire:ignore
        x-ref="input"
        wire:model="{{ $getName() }}"></div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5"></script>
@endpush
