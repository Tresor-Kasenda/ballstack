@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-danger text-danger-dim m-1 text-sm']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
