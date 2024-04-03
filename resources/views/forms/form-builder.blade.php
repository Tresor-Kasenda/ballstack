@php
    $schemas = $getSchema();
    $action = $getAction();
    $card = $isCard();
@endphp
@props([
    'schemas' => $schemas,
    'action' => $action,
    'card' => $card,
])

<div {{ $attributes->merge(['class' => 'nk-block nk-block-lg']) }}>
    @if($card)
        <div class="card">
            <div class="card-body pb-2">
                @endif
                <form wire:submit.prevent="submit" enctype="multipart/form-data">
                    <div class="row g-4">
                        @foreach($schemas as $index => $schema)
                            <div
                                @class([
                                    '',
                                    match ($getColumn()) {
                                        2 => 'col-lg-6 col-md-6 col-sm-12',
                                        3 => 'col-lg-4 col-md-4 col-sm-12',
                                        4 => 'col-lg-3 col-md-3 col-sm-12',
                                        default => 'col-sm-12'
                                    }
                                ])
                            >
                                {{ $schema }}
                            </div>
                        @endforeach
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dim btn-primary" wire:loading.attr="disabled">
                                    {{ $action ?? __('Submit') }}
                                </button>
                                <div wire:loading.delay.long class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if($card)
            </div>
        </div>
    @endif
</div>
