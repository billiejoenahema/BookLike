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
        <div class="flex-1 footer-fixed">
            <nav
                class="
                    navbar navbar-expand navbar-light
                    sticky-top
                    bg-imageColor
                    shadow-sm
                    py-0
                    mb-1
                "
            >
                <div class="container">
                    {{-- Brand Logo --}}
                    <a
                        class="navbar-brand d-block text-white"
                        href="{{ url('/') }}"
                    >
                        {{ config("app.name", "Laravel") }}
                    </a>
                </div>
            </nav>
            <main class="pt-2 main-min-height mb-5">
                <div class="container px-0">
                    <div class="error-wrap col-md-8 col-lg-6 mb-3 m-auto p-2">
                        @include('components.back_button')
                        <section>
                            <h1>@yield('title')</h1>
                            <p class="error-message">@yield('message')</p>
                        </section>
                    </div>
                </div>
            </main>
            {{-- Footer --}}
            <footer class="page-footer bg-imageColor font-small w-100">
                <div
                    class="
                        footer-copyright
                        d-flex
                        flex-wrap flex-row
                        justify-content-center
                        text-dark
                        py-3
                    "
                    style="box-shadow: 0 -2px 4px #eee"
                >
                    <a class="text-reset px-2" href="{{ url('/') }}"
                        >© 2020 Copyright: BookLike</a
                    >
                    <div class="px-2">
                        <a
                            class="text-reset small px-2"
                            href="{{ url('/terms') }}"
                            >利用規約</a
                        >
                        <a
                            class="text-reset small px-2"
                            href="{{ url('/privacy') }}"
                            >プライバシーポリシー</a
                        >
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
