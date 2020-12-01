@extends('layouts.app')

@section('content')
@include('components.back_button')
<div class="card shadow-sm">
    <div class="card-header">プロフィールを編集</div>
    @if($login_user->id == 1)
    <div class="disabled m-3">
        {{ __('ゲストユーザーはプロフィールを編集できません') }}
    </div>
    @else
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ url('users/' .$login_user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row align-items-center">
                <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('プロフィール写真') }}</label>
                <div class="col-md-6 d-flex align-items-center">
                    <img src="{{ $storage->url($login_user->profile_image) }}" class="rounded-circle mr-3" width="48"
                        height="48">
                    <input type="file" name="profile_image" class="@error('profile_image') is-invalid @enderror"
                        autocomplete="profile_image">
                    @error('profile_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="screen_name" class="col-md-4 col-form-label text-md-right">{{ __('アカウント名') }}</label>
                <div class="col-md-6">
                    <input id="screen_name" type="text" class="form-control @error('screen_name') is-invalid @enderror"
                        name="screen_name" value="{{ $login_user->screen_name }}" required autocomplete="screen_name"
                        autofocus>
                    @error('screen_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $login_user->name }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $login_user->email }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('好きなジャンル') }}</label>
                <div class="col-md-6">
                    <textarea id="category" type="text" class="form-control" name="category"
                        rows="2">{{ $login_user->category }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('自己紹介') }}</label>
                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control" name="description"
                        rows="4">{{ $login_user->description }}</textarea>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                    <button type="button" onclick="history.back()" class="btn btn-secondary rounded-pill">キャンセル</button>
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm">更新する</button>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection
