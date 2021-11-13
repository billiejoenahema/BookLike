<nav class="navbar navbar-expand navbar-light sticky-top bg-imageColor shadow-sm py-0 mb-1">
    <div class="container">
        {{-- Brand Logo --}}
        <div class="dropdown">
        {{-- <a class="navbar-brand d-block text-white" href="{{ url('/') }}"> --}}
        <a class="navbar-brand d-block text-white"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" data-toggle="modal" data-target="#newPostModal"
                role="button" href="#">新規投稿</a>
            <a class="dropdown-item" href="/">投稿一覧</a>
            <a class="dropdown-item" href="/users">ユーザー一覧</a>
            <a class="dropdown-item" href="/privacy">プライバシーポリシー</a>
            <a class="dropdown-item" href="/terms">利用規約</a>
        </div>
    </div>
        <ul class="navbar-nav text-blog">
            @if(!Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
            </li>
            @endif
            @elseif(Auth::user() && !Auth::user()->hasVerifiedEmail())
            <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @else
            {{-- New Post Button --}}
            <li class="nav-item d-flex align-items-center"><a href="#" class="text-darkGreen"
                data-toggle="modal" data-target="#newPostModal" role="button" title="新規投稿"><i
                class="fas fa-fw fa-plus h4 mr-1 mb-0 pt-1"></i></a>
            </li>
            {{-- User Icon --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle px-0 pl-sm-4" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/public/progile_image/Default_User_Icon.jpeg"
                        class="rounded-circle shadow-sm nav-icon" width="36" height="36" data-toggle="tooltip"
                        data-placement="bottom" title="{{ $login_user->screen_name }}">
                </a>
                {{-- Dropdown Menu --}}
                <div class="dropdown-menu dropdown-menu-right pb-0" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item pb-2 text-iron font-weight-bold border-bottom dropdown-user-name"
                        href="{{ url('users/' .$login_user->id) }}">{{ $login_user->name ?? $login_user->screen_name }}</a>
                    <a class="dropdown-item pt-2 pb-2" href="{{ url('users/' .$login_user->id) }}"><i
                        class="fas fa-user-cog fa-fw mr-2"></i>マイページ</a>
                    <a class="dropdown-item py-2" href="#" data-toggle="modal" data-target="#newPostModal"
                        role="button"><i class="fas fa-pen fa-fw mr-2"></i>新規投稿</a>
                    <a class="dropdown-item border-top py-2 bg-light logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
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
