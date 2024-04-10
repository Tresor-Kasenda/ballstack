@php
    $schemas = $getSchema();
    $action = $getAction();
    $card = $isCard();
@endphp

@props([
    'schemas' => $schemas,
    'action' => $action,
    'card' => $card,
])

<x-ballstack::card.bloc>
    @if($card)
        <x-ballstack::card>
            @endif
            <x-ballstack::form wire:submit.prevent="submit">
                <div class="row g-4">
                    @foreach($schemas as $index => $schema)
                        <x-ballstack::form.form-row wire:key="{{ $index }}" :key="$index" :column="$getColumn()">
                            {{ $schema }}
                        </x-ballstack::form.form-row>
                    @endforeach
                    <x-ballstack::button
                        :action="$action"
                    ></x-ballstack::button>
                </div>
            </x-ballstack::form>
            @if($card)
        </x-ballstack::card>
    @endif
</x-ballstack::card.bloc>
