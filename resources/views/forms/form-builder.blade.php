@php
    $schemas = $getSchema();
    $action = $getAction();
    $columns = $getColumn();
    $class = $columns == 2 ?
        'col-lg-6 col-md-6 col-sm-12' :
        ($columns == 3 ? 'col-lg-4 col-md-4 col-sm-12' :
        ($columns == 4 ? 'col-lg-3 col-md-3 col-sm-12' : 'col-sm-12'));
    $card = $isCard();
@endphp
<div class="nk-block nk-block-lg">
    @if($card)
        <div class="card">
            <div class="card-body pb-2">
                @endif
                <form wire:submit.prevent="storeData" enctype="multipart/form-data">
                    <div class="row g-4">
                        @foreach($schemas as $index => $schema)
                            <div class="{{ $class }}">
                                {{ $schema }}
                            </div>
                        @endforeach
                        <div class="col-12">
                            <div class="form-group d-flex">
                                <button type="submit" class="btn btn-dim btn-primary" wire:loading.attr="disabled">
                                    {{ $action ?? __('Submit') }}
                                </button>
                                <div wire:loading class="spinner-border spinner-border-sm" role="status">
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
