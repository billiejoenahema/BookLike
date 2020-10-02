@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('ログイン') }}</div>
            <div class="card-body m-auto">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <input  id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                placeholder="メールアドレス"
                                value="{{ old('email') }}"
                                required autocomplete="email"
                                autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <input  id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="パスワード"
                                required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('ログイン情報を保持する') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary shadow-sm">
                            {{ __('ログイン') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('パスワードをお忘れですか?') }}
                            </a>
                        @endif
                    </div>
                </form>
                <form class="form-group row" action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="guestuser@example.com">
                    <input type="hidden" name="password" value="guestuser+password">
                    <button type="submit" class="btn bg-gradient-success text-white shadow-sm w-100">
                        {{ __('お試しログイン') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
