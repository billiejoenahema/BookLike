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
    <link href="{{ asset('css/customize.css') }}" rel="stylesheet">
</head>

<body class="home-body bg-imageColor">
    <div class="flex-1 d-flex align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-5 col-8 m-auto flex-column text-center">
            <div class="h1 mb-4 text-center">
                BookLike
            </div>
            <p>読みたい本が必ず見つかる</p>
            <div class="d-flex justify-content-between mt-5">
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
        <div class="footer-copyright text-center text-blog py-3">
            © 2020 Copyright: BookLike
        </div>
    </footer>
</body>

</html>
