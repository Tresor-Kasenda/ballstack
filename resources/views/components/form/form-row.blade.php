@props([
    'column'
])
<div
    @class([
        match ($column) {
            2 => 'col-lg-6 col-md-6 col-sm-12',
            3 => 'col-lg-4 col-md-4 col-sm-12',
            4 => 'col-lg-3 col-md-3 col-sm-12',
            default => 'col-sm-12'
        }
    ])
>
    {{ $slot }}
</div>
