@php
    $name = $getName();
    $label = $getLabel();
    $placeholder = $getPlaceholder() ?? __('Select options...');
    $required = $getRequired();
    $disabled = $isDisabled();
    $options = $getOptions();
    $searchable = $isSearchable();
    $maxItems = $getMaxItems();
    $taggable = $isTaggable();
    $grouped = $isGrouped();
    $closeOnSelect = $shouldCloseOnSelect();
    $removeButton = $hasRemoveButton();
    $helpText = $getHelpText();
    $uniqueId = $getUniqueId();
@endphp

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <style>
        .choices__list--multiple .choices__item {
            background-color: #6576ff;
            border: 1px solid #6576ff;
            color: #fff;
            border-radius: 3px;
            padding: 4px 10px;
            margin-right: 3px;
            margin-bottom: 3px;
        }
        .choices__list--multiple .choices__item[data-deletable] .choices__button {
            border-left: 1px solid rgba(255,255,255,0.3);
            padding-left: 8px;
            margin-left: 4px;
        }
        .choices[data-type*=select-multiple] .choices__button {
            background-image: url("data:image/svg+xml,%3Csvg width='21' height='21' viewBox='0 0 21 21' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23FFF' fill-rule='evenodd'%3E%3Cpath d='M2.592.044l18.364 18.364-2.548 2.548L.044 2.592z'/%3E%3Cpath d='M0 18.364L18.364 0l2.548 2.548L2.548 20.912z'/%3E%3C/g%3E%3C/svg%3E");
        }
        .choices__inner {
            background-color: #fff;
            border: 1px solid #dbdfea;
            border-radius: 4px;
            min-height: 38px;
            padding: 4px 7.5px 2px;
        }
        .choices.is-focused .choices__inner {
            border-color: #6576ff;
            box-shadow: 0 0 0 0.2rem rgba(101, 118, 255, 0.1);
        }
        .is-invalid + .choices .choices__inner {
            border-color: #e85347;
        }
    </style>
@endpush

<x-ballstack::Inputs.control>
    @if($label)
        <x-ballstack::Inputs.label :name="$uniqueId">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </x-ballstack::Inputs.label>
    @endif

    <div class="form-control-wrap">
        <select
            id="{{ $uniqueId }}"
            name="{{ $name }}[]"
            multiple
            wire:model.live="{{ $name }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            class="form-control @error($name) is-invalid @enderror"
        >
            @if($grouped)
                @foreach($options as $group => $groupOptions)
                    <optgroup label="{{ $group }}">
                        @foreach($groupOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            @else
                @foreach($options as $value => $optionLabel)
                    <option value="{{ $value }}">{{ $optionLabel }}</option>
                @endforeach
            @endif
        </select>

        @error($name)
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        @if($helpText)
            <small class="form-text text-muted">{{ $helpText }}</small>
        @endif
    </div>
</x-ballstack::Inputs.control>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const element = document.getElementById('{{ $uniqueId }}');

            if (element && !element.choicesInstance) {
                const choices = new Choices(element, {
                    removeItemButton: {{ $removeButton ? 'true' : 'false' }},
                    searchEnabled: {{ $searchable ? 'true' : 'false' }},
                    searchPlaceholderValue: '{{ __('Search...') }}',
                    placeholderValue: '{{ $placeholder }}',
                    @if($maxItems)
                    maxItemCount: {{ $maxItems }},
                    maxItemText: (maxItemCount) => {
                        return `{{ __('Only') }} ${maxItemCount} {{ __('items can be selected') }}`;
                    },
                    @endif
                    @if($taggable)
                    addItems: true,
                    addItemFilter: (value) => {
                        // Allow custom values
                        return !!value;
                    },
                    @endif
                    shouldSort: false,
                    @if($closeOnSelect)
                    closeDropdownOnSelect: true,
                    @endif
                    itemSelectText: '{{ __('Press to select') }}',
                    noResultsText: '{{ __('No results found') }}',
                    noChoicesText: '{{ __('No choices to choose from') }}',
                });

                // Store instance for later cleanup
                element.choicesInstance = choices;

                // Sync with Livewire
                element.addEventListener('change', function(event) {
                    const selectedValues = Array.from(event.target.selectedOptions).map(option => option.value);
                    @this.set('{{ $name }}', selectedValues);
                });

                // Listen to Livewire updates
                Livewire.hook('morph.updated', ({ el, component }) => {
                    if (el.id === '{{ $uniqueId }}') {
                        const currentValues = @this.get('{{ $name }}') || [];
                        choices.removeActiveItems();
                        choices.setValue(currentValues);
                    }
                });
            }
        });

        // Cleanup on page navigation
        document.addEventListener('livewire:navigating', () => {
            const element = document.getElementById('{{ $uniqueId }}');
            if (element && element.choicesInstance) {
                element.choicesInstance.destroy();
                delete element.choicesInstance;
            }
        });
    </script>
@endpush
