@php
    $schemas = $getSchemas();
    $alignment = $getAlignment();
@endphp
<div
    class="{{ $alignment === 'vertical' ? 'row g-gs' : 'card card-bordered card-preview card-inner' }}">
    <div class="{{ $alignment === 'vertical' ? 'col-md-4' : '' }}">
        <ul class="nav {{ $alignment === 'vertical' ? 'link-list-menu border border-light round m-0' : 'nav-tabs' }}">
            @foreach($schemas as $index  => $schema)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                       href="#tab-{{ $index }}">
                        <em class="icon ni ni-{{ $schema->getIcon() }}"></em>
                        <span>{{ $schema->getName() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="{{ $alignment === 'vertical' ? 'col-md-8' : 'mt-2' }}">
        <div class="tab-content">
            @foreach($schemas as $index => $schema)
                <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $index }}">
                    {{ $schema }}
                </div>
            @endforeach
        </div>
    </div>
</div>
