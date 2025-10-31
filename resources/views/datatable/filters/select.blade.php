@props(['filter', 'name', 'options', 'placeholder', 'multiple'])

<div class="form-group">
    <label for="filter-{{ $name }}" class="form-label">{{ $filter->getLabel() }}</label>
    <select
        id="filter-{{ $name }}"
        class="form-control"
        wire:model.live="filters.{{ $name }}"
        @if($multiple) multiple @endif
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</div>
