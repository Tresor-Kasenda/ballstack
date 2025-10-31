@props(['filter', 'name', 'format', 'startPlaceholder', 'endPlaceholder'])

<div class="form-group">
    <label class="form-label">{{ $filter->getLabel() }}</label>
    <div class="row g-2">
        <div class="col-md-6">
            <input
                type="date"
                id="filter-{{ $name }}-start"
                class="form-control"
                placeholder="{{ $startPlaceholder }}"
                wire:model.live="filters.{{ $name }}.start"
            />
        </div>
        <div class="col-md-6">
            <input
                type="date"
                id="filter-{{ $name }}-end"
                class="form-control"
                placeholder="{{ $endPlaceholder }}"
                wire:model.live="filters.{{ $name }}.end"
            />
        </div>
    </div>
</div>
