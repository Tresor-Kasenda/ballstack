@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'ff-mono text-sm']) }}>
        {{ $status }}
    </div>
@endif
