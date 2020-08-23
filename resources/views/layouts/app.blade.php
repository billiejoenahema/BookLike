<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/selected.css') }}">
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm sticky-top col-12">
            <div class="container">

                <!-- ロゴ -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto align-items-center d-flex flex-row justify-content-end">
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

                        <!-- 新規投稿ボタン -->
                        <li class="nav-item mr-2">
                            <a href="{{ url('reviews/create') }}">
                                <button class="btn btn-primary rounded-circle font-weight-bold shadow-sm"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Tooltip on bottom">
                                    <span>+</span>
                                </button>
                            </a>
                        </li>
                        <li class="nav-item">
                        </li>

                        <!-- ユーザーアイコン -->
                        <li class="nav-item">
                            <a href="{{ url('users/' .$login_user->id) }}">
                            @if($login_user->profile_image === null)
                                <img src="{{ $default_image }}"
                                    class="rounded-circle shadow-sm"
                                    width="40" height="40">
                            @else
                                <img src="{{ asset('storage/profile_image/'.$login_user->profile_image) }}"
                                    class="rounded-circle shadow-sm"
                                    width="40" height="40">
                            @endif
                            </a>
                        </li>

                        <!-- ドロップダウンメニュー -->
                        <div class="dropdown p-1">
                            <a class="btn dropdown-toggle"
                            href="#" role="button"
                            id="dropdownMenuLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
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
                        </div>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if($login_user->id == 1)
            <div class="bg-success text-center text-white col-12">
                {{ __('ゲストユーザーとしてログインしています') }}
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
