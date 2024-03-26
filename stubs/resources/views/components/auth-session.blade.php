@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm']) }}>
        {{ $status }}
    </div>
@endif
