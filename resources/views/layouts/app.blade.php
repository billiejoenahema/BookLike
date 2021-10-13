<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config("app.name", "Laravel") }}</title>
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('js/all.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito"
            rel="stylesheet"
        />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/customize.css') }}" rel="stylesheet" />
        <!-- Font Awesome -->
        <link
            href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
            rel="stylesheet"
        />
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" />
    </head>
    <body id="body">
        <div class="footer-fixed">
            {{-- Header --}}
            @include('layouts.header')
            <main class="pt-2 main-min-height mb-3">
                <div class="container px-0">
                    <div class="col-md-10 col-lg-8 mb-3 m-auto px-2">
                        {{-- Flash Message --}}
                        @include('components.flash_message')
                        {{-- Main Content --}}
                        @yield('content')
                    </div>
                </div>
            </main>
            {{-- Footer --}}
            @include('layouts.footer') @include('layouts.new_post_modal')
        </div>
        <div id="fadeLayer"></div>
    </body>
</html>
