@props([
    'title'
])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="">
    <title>{{ config('app.name') }} | {{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('assets/js/bundle.js') }}" data-navigate-track data-navigate-once></script>
    <script src="{{ asset('assets/js/scripts.js') }}" data-navigate-track data-navigate-once></script>
    @stack('styles')

    <style>
        [x-cloak=''],
        [x-cloak='x-cloak'],
        [x-cloak='1'] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak='-lg'] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak='lg'] {
                display: none !important;
            }
        }
    </style>

    @ballStackScripts
</head>
<body class="nk-body bg-lighter npc-default has-sidebar ff-base ui-bordered">
<div class="nk-app-root">
    <div class="nk-main ">
        {{ $sidebar }}
        <div class="nk-wrap ">
            {{ $header }}
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
            <x-footer/>
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
