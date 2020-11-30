@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <div class="card-header">{{ __('ログイン') }}</div>
    <div class="card-body m-auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <input id="email" type="email" oninput="checkForm()"
                    class="form-control rounded-pill @error('email') is-invalid @enderror" name="email"
                    placeholder="メールアドレス" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <input id="password" type="password" oninput="checkForm()"
                    class="form-control rounded-pill @error('password') is-invalid @enderror" name="password"
                    placeholder="パスワード" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('ログイン情報を保持する') }}
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <button id="login" type="submit" class="btn btn-primary rounded-pill shadow-sm disabled">
                    {{ __('ログイン') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('パスワードをお忘れですか?') }}
                </a>
                @endif
            </div>
        </form>
        <form class="form-group row mb-0" action="{{ route('login.guest') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-seaGreen text-white rounded-pill shadow-sm w-100 mt-3">
                {{ __('お試しログイン') }}
            </button>
        </form>
    </div>
</div>
@endsection
