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
    <script src="{{ asset('js/all.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customize.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
</head>

<body id="body">
    <div class="flex-1 footer-fixed">
        <nav class="navbar navbar-expand navbar-light sticky-top bg-imageColor shadow-sm py-0 mb-1">
            <div class="container">
                {{-- Brand Logo --}}
                <a class="navbar-brand d-block text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="navbar-nav text-blog">
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
                    {{-- New Post Button --}}
                    <li class="nav-item d-flex align-items-center"><a href="{{ url('reviews/create') }}"
                            class="text-darkGreen" title="新規投稿"><i class="fas fa-fw fa-plus h3 m-0"></i></a>
                    </li>
                    {{-- User Icon --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-0 pl-sm-4" href="#" id="navbarDropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ $storage->url($login_user->profile_image) }}"
                                class="rounded-circle shadow-sm nav-icon" width="36" height="36" data-toggle="tooltip"
                                data-placement="bottom" title="{{ $login_user->name }}">
                        </a>
                        {{-- Dropdown Menu --}}
                        <div class="dropdown-menu dropdown-menu-right pb-0" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item pt-2 pb-2" href="{{ url('users/' .$login_user->id) }}"><i
                                    class="fas fa-user-cog fa-fw mr-2"></i>マイページ</a>
                            <a class="dropdown-item py-2" href="{{ url('reviews/create') }}"><i
                                    class="fas fa-pen fa-fw mr-2"></i>新規投稿</a>
                            <a class="dropdown-item py-2" href="{{ url('reviews') }}"><i
                                    class="fas fa-book-open fa-fw mr-2"></i>投稿一覧</a>
                            <a class="dropdown-item pt-2 pb-3" href="{{ url('users') }}"><i
                                    class="fas fa-users fa-fw mr-2"></i>ユーザー一覧</a>
                            <a class="dropdown-item border-top py-3 bg-light" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-fw mr-2"></i>ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <main class="pt-2 main-min-height mb-5">
            <div class="container px-0">
                <div class="col-md-10 col-lg-8 mb-3 m-auto p-2">
                    {{-- Flash Message --}}
                    @if (session('flash_message'))
                    <div class="flash_message col-10 col-sm-8 col-md-6" id="flashMessage">
                        {{ session('flash_message') }}
                    </div>
                    @endif
                    {{-- Main Content --}}
                    @yield('content')
                </div>
            </div>
        </main>
        {{-- Footer --}}
        @include('layouts.footer')
    </div>
</body>

</html>
