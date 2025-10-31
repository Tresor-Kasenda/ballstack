@php
    $name = $getName();
    $label = $getLabel();
    $required = $getRequired();
    $disabled = $isDisabled();
    $stars = $getStars();
    $allowHalf = $isHalfAllowed();
    $readOnly = $isReadOnly();
    $icon = $getIcon();
    $color = $getColor();
    $size = $getSize();
    $showValue = $shouldShowValue();
    $helpText = $getHelpText();
    $uniqueId = $getUniqueId();

    // Icon mapping
    $iconMap = [
        'star' => '★',
        'heart' => '♥',
        'thumb' => '👍',
    ];
    $iconChar = $iconMap[$icon] ?? '★';

    // Color mapping
    $colorMap = [
        'primary' => '#6576ff',
        'warning' => '#ffa353',
        'danger' => '#e85347',
        'success' => '#1ee0ac',
        'info' => '#09c2de',
    ];
    $colorValue = $colorMap[$color] ?? $colorMap['warning'];

    // Size mapping
    $sizeMap = [
        'sm' => '1.5rem',
        'md' => '2rem',
        'lg' => '3rem',
    ];
    $sizeValue = $sizeMap[$size] ?? $sizeMap['md'];
@endphp

<style>
    .rating-container-{{ $uniqueId }} {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    .rating-star-{{ $uniqueId }} {
        cursor: pointer;
        font-size: {{ $sizeValue }};
        color: #e4e6ef;
        transition: color 0.2s ease;
        user-select: none;
    }
    .rating-star-{{ $uniqueId }}.filled {
        color: {{ $colorValue }};
    }
    .rating-star-{{ $uniqueId }}.half-filled {
        position: relative;
        display: inline-block;
    }
    .rating-star-{{ $uniqueId }}.half-filled::before {
        content: '{{ $iconChar }}';
        position: absolute;
        left: 0;
        width: 50%;
        overflow: hidden;
        color: {{ $colorValue }};
    }
    .rating-star-{{ $uniqueId }}:hover {
        transform: scale(1.1);
    }
    @if($readOnly || $disabled)
    .rating-star-{{ $uniqueId }} {
        cursor: default;
        pointer-events: none;
    }
    @endif
    .rating-value-display {
        margin-left: 0.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: #526484;
    }
</style>

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
        <div
            x-data="{
                rating: @entangle($name).live,
                hoverRating: 0,
                stars: {{ $stars }},
                allowHalf: {{ $allowHalf ? 'true' : 'false' }},
                readOnly: {{ ($readOnly || $disabled) ? 'true' : 'false' }},

                setRating(value) {
                    if (!this.readOnly) {
                        this.rating = value;
                    }
                },

                getStarClass(index) {
                    const value = this.hoverRating || this.rating || 0;

                    if (this.allowHalf) {
                        if (value >= index) {
                            return 'filled';
                        } else if (value >= index - 0.5) {
                            return 'half-filled';
                        }
                    } else {
                        if (value >= index) {
                            return 'filled';
                        }
                    }

                    return '';
                },

                handleClick(index, event) {
                    if (this.readOnly) return;

                    if (this.allowHalf) {
                        const rect = event.target.getBoundingClientRect();
                        const x = event.clientX - rect.left;
                        const halfWidth = rect.width / 2;

                        if (x < halfWidth) {
                            this.setRating(index - 0.5);
                        } else {
                            this.setRating(index);
                        }
                    } else {
                        this.setRating(index);
                    }
                },

                handleMouseMove(index, event) {
                    if (this.readOnly) return;

                    if (this.allowHalf) {
                        const rect = event.target.getBoundingClientRect();
                        const x = event.clientX - rect.left;
                        const halfWidth = rect.width / 2;

                        if (x < halfWidth) {
                            this.hoverRating = index - 0.5;
                        } else {
                            this.hoverRating = index;
                        }
                    } else {
                        this.hoverRating = index;
                    }
                },

                handleMouseLeave() {
                    this.hoverRating = 0;
                }
            }"
            class="rating-container-{{ $uniqueId }}"
            @mouseleave="handleMouseLeave()"
        >
            <template x-for="i in stars" :key="i">
                <span
                    class="rating-star-{{ $uniqueId }}"
                    :class="getStarClass(i)"
                    @click="handleClick(i, $event)"
                    @mousemove="handleMouseMove(i, $event)"
                >{{ $iconChar }}</span>
            </template>

            @if($showValue)
                <span class="rating-value-display" x-text="(rating || 0).toFixed({{ $allowHalf ? 1 : 0 }})"></span>
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
