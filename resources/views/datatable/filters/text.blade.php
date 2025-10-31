@props(['filter', 'name', 'placeholder'])

<div class="form-group">
    <label for="filter-{{ $name }}" class="form-label">{{ $filter->getLabel() }}</label>
    <input
        type="text"
        id="filter-{{ $name }}"
        class="form-control"
        placeholder="{{ $placeholder }}"
        wire:model.live.debounce.300ms="filters.{{ $name }}"
    />
</div>
