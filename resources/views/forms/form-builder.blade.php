@php
    $schemas = $getSchema();
    $route = $getRoute();
    $columns = $getColumn();
    $class = $columns == 2 ?
        'col-lg-6 col-md-6 col-sm-12' :
        ($columns == 3 ? 'col-lg-4 col-md-4 col-sm-12' :
        ($columns == 4 ? 'col-lg-3 col-md-3 col-sm-12' : 'col-sm-12'));
@endphp
<div class="nk-block nk-block-lg">
    <div class="card">
        <div class="card-body pb-2">
            <form wire:submit.prevent="storeData" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    @foreach($schemas as $index => $schema)
                        <div class="{{ $class }}">
                            {{ $schema }}
                        </div>
                    @endforeach
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dim btn-primary" wire:loading.attr="disabled">
                                <em wire:loading.remove class="icon ni ni-save"></em>
                                <span wire:loading.remove>Enregistrer</span>
                                <span wire:loading class="spinner-border spinner-border-sm" role="status"
                                      aria-hidden="true"></span>
                                <span wire:loading>Loading...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
