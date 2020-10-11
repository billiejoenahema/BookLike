<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BookLike</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/customize.css') }}" rel="stylesheet">
        <style>
            html, body {
                /* background-color: #fff; */
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-1 {
                flex: 1;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="bg-imageColor">
        <div class="flex-1 d-flex align-items-center">
            <div class="container m-auto flex-column text-center">
                <div class="title m-b-md text-center">
                    BookLike
                </div>
                <div class="d-inline-flex col-6 justify-content-between">
                    <a class="" href="{{ route('login') }}">
                        <button class="btn btn-primary rounded-pill">
                            {{ __('ログイン') }}
                        </button>
                    </a>
                @if (Route::has('register'))
                    <a class="" href="{{ route('register') }}">
                        <button class="btn btn-orange rounded-pill">
                            {{ __('新規登録') }}
                        </button>
                    </a>
                @endif
                </div>
            </div>
        </div>
        <footer class="page-footer font-small">
            <!-- Copyright -->
                <div class="footer-copyright text-center text-blog py-3">
                    © 2020 Copyright:BookLike
                </div>
            <!-- Copyright -->
            </footer>
    </body>
</html>
