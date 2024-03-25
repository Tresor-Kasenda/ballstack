<div class="form-group">
    <button
        {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }}
    >
        {{ $slot }}
    </button>
</div>
