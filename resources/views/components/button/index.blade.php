@props([
    'action'
])
<div
    {{ $attributes->merge(['class' => 'col-12']) }}
    wire:ignore
>
    <div class="form-group">
        <button type="submit" class="btn btn-dim btn-primary">
            <div
                wire:loading.delay.long wire:loading.flex wire:target="submit"
                class="spinner-border spinner-border-sm"
                role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span wire:loading.class="invisible" wire:target="submit">
                {{ $action ?? __('Submit') }}
            </span>
        </button>
    </div>
</div>
