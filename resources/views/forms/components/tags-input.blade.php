@php
    $name = $getName();
    $label = $getLabel();
    $placeholder = $getPlaceholder() ?? __('Add tags...');
    $required = $getRequired();
    $disabled = $isDisabled();
    $suggestions = $getSuggestions();
    $maxTags = $getMaxTags();
    $separator = $getSeparator();
    $allowDuplicates = $getDuplicates();
    $trimTags = $shouldTrimTags();
    $dropdown = $hasDropdown();
    $enforceWhitelist = $isWhitelistEnforced();
    $minChars = $getMinChars();
    $helpText = $getHelpText();
    $uniqueId = $getUniqueId();
@endphp

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <style>
        .tagify {
            border: 1px solid #dbdfea;
            border-radius: 4px;
            min-height: 38px;
        }
        .tagify:hover {
            border-color: #6576ff;
        }
        .tagify.tagify--focus {
            border-color: #6576ff;
            box-shadow: 0 0 0 0.2rem rgba(101, 118, 255, 0.1);
        }
        .tagify__tag {
            background-color: #6576ff;
            color: #fff;
            margin: 2px;
        }
        .tagify__tag__removeBtn {
            color: #fff;
        }
        .tagify__tag__removeBtn:hover {
            background: rgba(255,255,255,0.2);
        }
        .tagify__dropdown {
            border: 1px solid #dbdfea;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .tagify__dropdown__item--active {
            background-color: #6576ff;
            color: #fff;
        }
        .tagify.is-invalid {
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
        <input
            type="text"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            class="form-control @error($name) is-invalid @enderror"
            wire:model.live="{{ $name }}"
        />

        @error($name)
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        @if($helpText)
            <small class="form-text text-muted">{{ $helpText }}</small>
        @endif
    </div>
</x-ballstack::Inputs.control>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('{{ $uniqueId }}');

            if (input && !input.tagifyInstance) {
                const tagify = new Tagify(input, {
                    @if(count($suggestions) > 0)
                    whitelist: @json($suggestions),
                    @endif
                    @if($maxTags)
                    maxTags: {{ $maxTags }},
                    @endif
                    delimiters: '{{ $separator }}',
                    duplicates: {{ $allowDuplicates ? 'true' : 'false' }},
                    trim: {{ $trimTags ? 'true' : 'false' }},
                    dropdown: {
                        enabled: {{ $dropdown ? $minChars : 'false' }},
                        maxItems: 10,
                        classname: "tagify__dropdown",
                        closeOnSelect: true,
                        highlightFirst: true
                    },
                    @if($enforceWhitelist && count($suggestions) > 0)
                    enforceWhitelist: true,
                    @endif
                    @if($disabled)
                    readonly: true,
                    @endif
                    placeholder: '{{ $placeholder }}',
                    originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join('{{ $separator }}')
                });

                // Store instance
                input.tagifyInstance = tagify;

                // Sync with Livewire on tag changes
                tagify.on('change', function(e) {
                    const tags = tagify.value.map(tag => tag.value);
                    @this.set('{{ $name }}', tags);
                });

                // Listen to max tags exceed
                @if($maxTags)
                tagify.on('invalid', function(e) {
                    if (e.detail.message === 'number of tags exceeded') {
                        // You can show a toast notification here
                        console.log('{{ __('Maximum') }} {{ $maxTags }} {{ __('tags allowed') }}');
                    }
                });
                @endif

                // Sync Livewire updates back to Tagify
                Livewire.hook('morph.updated', ({ el, component }) => {
                    if (el.id === '{{ $uniqueId }}') {
                        const currentTags = @this.get('{{ $name }}') || [];
                        if (Array.isArray(currentTags)) {
                            tagify.removeAllTags();
                            tagify.addTags(currentTags);
                        }
                    }
                });
            }
        });

        // Cleanup on page navigation
        document.addEventListener('livewire:navigating', () => {
            const input = document.getElementById('{{ $uniqueId }}');
            if (input && input.tagifyInstance) {
                input.tagifyInstance.destroy();
                delete input.tagifyInstance;
            }
        });
    </script>
@endpush
