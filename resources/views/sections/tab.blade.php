@php
    $schema = $getSchema();
    $column = $getColumn();
    $class = $column == 2 ? 'col-lg-6 col-md-6 col-sm-12' :
    ($column == 3 ? 'col-lg-4 col-md-4 col-sm-12' :
    ($column == 4 ? 'col-lg-3 col-md-3 col-sm-12': 'col-12'));
@endphp
<div class="row g-4">
    @foreach($schema as $index => $value)
        <div class="{{ $class }}" wire:key="{{ $index }}">
            {{ $value }}
        </div>
    @endforeach
</div>
