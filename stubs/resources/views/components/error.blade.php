@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-danger m-1 text-sm']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
