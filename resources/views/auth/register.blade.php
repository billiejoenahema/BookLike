@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        {{ __('新規登録') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <label for="screen_name" class="col-md-4 col-form-label text-md-right">
                    {{ __('アカウント名') }}
                </label>
                <div class="col-md-8">
                    <input id="screen_name" type="text"
                        class="form-control rounded-pill @error('screen_name') is-invalid @enderror" name="screen_name"
                        value="{{ old('screen_name') }}" required autocomplete="screen_name" placeholder="AccountName"
                        autofocus>

                    @error('screen_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    {{ __('氏名') }}
                </label>

                <div class="col-md-8">
                    <input id="name" type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') ?? '' }}" autocomplete="name" placeholder="山田 太郎" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                <div class="col-md-8">
                    <input id="email" type="email"
                        class="form-control rounded-pill @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="example@example.com">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                <div class="col-md-8">
                    <input id="password" type="password"
                        class="form-control rounded-pill @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password" placeholder="8文字以上の半角英数字で入力してください">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                    class="col-md-4 col-form-label text-md-right">{{ __('パスワード（確認用）') }}</label>

                <div class="col-md-8">
                    <input id="password-confirm" type="password" class="form-control rounded-pill"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="もう一度パスワードを入力してください">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary rounded-pill">
                        {{ __('登録する') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
