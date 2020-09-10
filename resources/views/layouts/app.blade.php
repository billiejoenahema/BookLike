<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('/js/deletePost.js') }}" defer></script>
    <script src="{{ asset('/js/selectItem.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/floating_button.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-light bg-info shadow-sm sticky-top">
            <div class="container">

                <!-- ロゴ -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                            </li>
                        @endif
                    @else

                        <!-- ユーザーアイコン -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}"
                                    class="rounded-circle shadow-sm img-fluid"
                                    width="40" height="40">
                            </a>
                            <!-- ドロップダウンメニュー -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('reviews/create') }}">新規投稿</a>
                                <a class="dropdown-item" href="{{ url('users') }}">ユーザーを探す</a>
                                <a class="dropdown-item" href="{{ url('users/' .$login_user->id) }}">マイページ</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
            </div>
        </nav>
            <div class="flash_message container text-center" id="flashMessage">
            @if (session('flash_message'))
                {{ session('flash_message') }}
            @endif
            </div>
        <main class="py-4">
            @yield('content')
        </main>
        <!-- 新規投稿ボタン -->
            <a class="text-whited-block btn-primary floating-button rounded-circle shadow"
                href="{{ url('reviews/create') }}"
                data-toggle="tooltip"
                data-placement="top"
                title="新規投稿">
                <i class="fas fa-plus"></i>
            </a>
        <!-- Footer -->
        <footer class="page-footer font-small bg-info shadow-sm mt-5">

        <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a class="text-reset" href="{{ url('/') }}"> BookLike</a>
            </div>
        <!-- Copyright -->

        </footer>
    </div>
</body>
</html>
