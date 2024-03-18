@props(['title' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="{{ route('login') }}" class="logo-link">
                                        <img class="logo-img logo-img-lg" src="{{ asset('/images/logo_full.jpg') }}" alt="logo">
                                    </a>
                                </div>
                                {{ $slot }}
                            </div>
                        </div>
                        <div class="nk-split-content nk-split-stretch bg-abstract" style="background-image: url('{{ asset('images/cover.jpg') }}')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
