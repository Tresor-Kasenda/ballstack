@php
    $name = $getName();
    $label = $getLabel();
    $required = $getRequired();
    $disabled = $isDisabled();
    $min = $getMin();
    $max = $getMax();
    $step = $getStep();
    $prefix = $getPrefix();
    $suffix = $getSuffix();
    $showValue = $shouldShowValue();
    $range = $isRange();
    $tooltips = $hasTooltips();
    $orientation = $getOrientation();
    $color = $getColor();
    $helpText = $getHelpText();
    $uniqueId = $getUniqueId();

    // Color mapping
    $colorMap = [
        'primary' => '#6576ff',
        'success' => '#1ee0ac',
        'warning' => '#ffa353',
        'danger' => '#e85347',
        'info' => '#09c2de',
    ];
    $colorValue = $colorMap[$color] ?? $colorMap['primary'];
@endphp

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/nouislider/dist/nouislider.min.css" rel="stylesheet">
    <style>
        .slider-container-{{ $uniqueId }} {
            padding: 20px 10px;
        }
        .slider-{{ $uniqueId }} {
            @if($orientation === 'vertical')
            height: 200px;
            @endif
        }
        .slider-{{ $uniqueId }} .noUi-connect {
            background: {{ $colorValue }};
        }
        .slider-{{ $uniqueId }} .noUi-handle {
            border: 2px solid {{ $colorValue }};
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .slider-{{ $uniqueId }} .noUi-handle:before,
        .slider-{{ $uniqueId }} .noUi-handle:after {
            background: {{ $colorValue }};
        }
        .slider-{{ $uniqueId }} .noUi-tooltip {
            background: {{ $colorValue }};
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 4px 8px;
            font-size: 12px;
        }
        .slider-value-display-{{ $uniqueId }} {
            text-align: center;
            margin-top: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #526484;
        }
        @if($disabled)
        .slider-{{ $uniqueId }} {
            opacity: 0.6;
            pointer-events: none;
        }
        @endif
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
        <div class="slider-container-{{ $uniqueId }}">
            <div id="slider-{{ $uniqueId }}" class="slider-{{ $uniqueId }}"></div>

            @if($showValue)
                <div id="slider-value-{{ $uniqueId }}" class="slider-value-display-{{ $uniqueId }}">
                    <span id="value-text-{{ $uniqueId }}"></span>
                </div>
            @endif
        </div>

        <input
            type="hidden"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            wire:model.live="{{ $name }}"
            @if($required) required @endif
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
    <script src="https://cdn.jsdelivr.net/npm/nouislider/dist/nouislider.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderElement = document.getElementById('slider-{{ $uniqueId }}');
            const hiddenInput = document.getElementById('{{ $uniqueId }}');
            const valueDisplay = document.getElementById('value-text-{{ $uniqueId }}');

            if (sliderElement && !sliderElement.noUiSlider) {
                // Get initial value from Livewire
                let initialValue = @this.get('{{ $name }}') || @if($range) [{{ $min }}, {{ $max }}] @else {{ $min }} @endif;

                // Format value with prefix/suffix
                const formatValue = (value) => {
                    let formatted = '';
                    @if($prefix)
                    formatted += '{{ $prefix }}';
                    @endif
                    formatted += parseFloat(value).toFixed({{ $step < 1 ? (strlen(substr(strrchr($step, "."), 1)) ?? 0) : 0 }});
                    @if($suffix)
                    formatted += '{{ $suffix }}';
                    @endif
                    return formatted;
                };

                // Create slider
                noUiSlider.create(sliderElement, {
                    start: initialValue,
                    connect: @if($range) true @else [true, false] @endif,
                    orientation: '{{ $orientation }}',
                    range: {
                        'min': {{ $min }},
                        'max': {{ $max }}
                    },
                    step: {{ $step }},
                    @if($tooltips)
                    tooltips: @if($range) [true, true] @else true @endif,
                    format: {
                        to: function(value) {
                            return formatValue(value);
                        },
                        from: function(value) {
                            return parseFloat(value.replace(/[^0-9.-]/g, ''));
                        }
                    },
                    @endif
                    @if($disabled)
                    disabled: true,
                    @endif
                });

                // Update hidden input and display on slider change
                sliderElement.noUiSlider.on('update', function(values, handle) {
                    @if($range)
                    const rawValues = values.map(v => parseFloat(v.replace(/[^0-9.-]/g, '')));
                    hiddenInput.value = JSON.stringify(rawValues);
                    @this.set('{{ $name }}', rawValues);

                    if (valueDisplay) {
                        valueDisplay.textContent = values[0] + ' - ' + values[1];
                    }
                    @else
                    const rawValue = parseFloat(values[0].replace(/[^0-9.-]/g, ''));
                    hiddenInput.value = rawValue;
                    @this.set('{{ $name }}', rawValue);

                    if (valueDisplay) {
                        valueDisplay.textContent = values[0];
                    }
                    @endif
                });

                // Listen to Livewire updates
                Livewire.hook('morph.updated', ({ el, component }) => {
                    if (el.id === 'slider-{{ $uniqueId }}') {
                        const currentValue = @this.get('{{ $name }}');
                        if (currentValue !== null && currentValue !== undefined) {
                            sliderElement.noUiSlider.set(currentValue);
                        }
                    }
                });
            }
        });

        // Cleanup on page navigation
        document.addEventListener('livewire:navigating', () => {
            const sliderElement = document.getElementById('slider-{{ $uniqueId }}');
            if (sliderElement && sliderElement.noUiSlider) {
                sliderElement.noUiSlider.destroy();
            }
        });
    </script>
@endpush
