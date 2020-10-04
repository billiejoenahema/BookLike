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
    <script src="{{ asset('/js/checkTextLength.js') }}" defer></script>
    <script src="{{ asset('/js/initialTextLength.js') }}" defer></script>
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
    <nav class="navbar navbar-expand navbar-light bg-blog shadow-sm sticky-top py-1">
        <div class="container">
            <!-- ロゴ -->
            <a class="navbar-brand d-block text-white" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('新規登録') }}</a>
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
                            <a class="dropdown-item" href="{{ url('reviews/create') }}"><i class="fas fa-pen mr-1"></i>新規投稿</a>
                            <a class="dropdown-item" href="{{ url('users') }}"><i class="fas fa-search mr-1"></i>ユーザーを探す</a>
                            <a class="dropdown-item" href="{{ url('users/' .$login_user->id) }}"><i class="fas fa-user mr-1"></i>マイページ</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1"></i>ログアウト
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
    <main class="pt-2 pb-5">
        <div class="container px-0">
            <div class="col-md-10 col-lg-8 mb-3 m-auto">
            <div class="flash_message text-center" id="flashMessage">
        @if (session('flash_message'))
            {{ session('flash_message') }}
        @endif
        </div>
        <div class="d-flex justify-content-between mb-3">
            <button type="button" onclick="history.back()" class="btn">
                <i class="fas fa-chevron-left"></i> 戻る
            </button>
            <div class="btn">
                <a href="{{ url('users') }}" class="text-reset">ユーザ一を探す</a>
            </div>
        </div>
            @yield('content')
            <!-- 新規投稿ボタン -->
            <a class="d-block"
                href="{{ url('reviews/create') }}"
                data-toggle="tooltip"
                data-placement="top"
                title="新規投稿">
                <button class="text-white btn-blog floating-button rounded-circle border-0 shadow">
                    <i class="fas fa-plus"></i>
                </button>
            </a>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="page-footer font-small mt-5 pt-5">

    <!-- Copyright -->
        <div class="footer-copyright text-center text-blog py-3" style="box-shadow: 0 -2px 4px #eee;">© 2020 Copyright:
            <a class="text-reset" href="{{ url('/') }}">BookLike</a>
        </div>
    <!-- Copyright -->

    </footer>
</body>
</html>
