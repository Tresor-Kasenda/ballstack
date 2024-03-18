@php
    $name = $getName();
    $description = $getDescription();
    $schemas = $getSchema();
    $columns = $getColumn();
    $icon = $getIcon();
    $class = $columns == 2 ? 'col-lg-6 col-md-6 col-sm-12' : ($columns == 3 ? 'col-lg-4 col-md-4 col-sm-12' : 'col-12');
@endphp
<div class="nk-stepper-step">
    <div class="d-flex gap-2">
        @if($icon)
            <em class="icon icon-circle icon-circle-lg ni ni-{{ $icon }}"></em>
        @endif
        <div style="padding: 0; margin: -3px">
            <h5 class="title">{{ $name }}</h5>
            @if($description)
                <span class="text-muted mt-0">{{ $description }}</span>
            @endif
        </div>
    </div>

    <ul class="row g-3 mt-5">
        @foreach($schemas as $schema)
            <li class="{{ $class }}">
                {{ $schema }}
            </li>
        @endforeach
    </ul>
</div>
