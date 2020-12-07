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
            {{-- プロフィール写真 --}}
            <div class="form-group row align-items-center">
                <label for="profile_image"
                    class="col-md-4 col-form-label text-md-right user-select-none">{{ __('プロフィール写真') }}</label>
                <div class="col-md-7 d-flex align-items-center">
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
            {{-- アカウント名 --}}
            <div class="form-group row">
                <label for="screen_name" class="col-md-4 col-form-label text-md-right user-select-none">
                    アカウント名
                </label>
                <div class="col-md-7">
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
            {{-- 氏名 --}}
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right user-select-none">{{ __('氏名') }}</label>
                <div class="col-md-7">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $login_user->name ?? '' }}" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- メールアドレス --}}
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right user-select-none">メールアドレス</label>
                <div class="col-md-7">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $login_user->email }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- 好きなジャンル --}}
            <div class="form-group row">
                <label for="category"
                    class="col-md-4 col-form-label text-md-right user-select-none">{{ __('好きなジャンル') }}</label>
                <div class="col-md-7">
                    <textarea id="category" type="text" class="form-control" name="category"
                        rows="2">{{ $login_user->category }}</textarea>
                </div>
            </div>
            {{-- 自己紹介文 --}}
            <div class="form-group row">
                <label for="description"
                    class="col-md-4 col-form-label text-md-right user-select-none">{{ __('自己紹介') }}</label>
                <div class="col-md-7">
                    <textarea id="description" type="text" class="form-control" name="description"
                        rows="4">{{ $login_user->description }}</textarea>
                </div>
            </div>
            {{-- 人生を変えた一冊 --}}
            <div class="form-group row">
                <label for="asin"
                    class="col-md-4 col-form-label text-md-right user-select-none">{{ __('人生を変えた一冊') }}</label>
                <div class="col-md-7">
                    <select name="asin" id="asin" class="form-control">
                        <option value="" default>{{ $book_title ?? '未設定' }}</option>
                        @if($userReviews)
                        @foreach($userReviews as $userReview)
                        <option value="{{ $userReview->asin }}">{{ $userReview->title }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            {{-- この本を選んだ理由 --}}
            <div class="form-group row">
                <label for="story"
                    class="col-md-4 col-form-label text-md-right user-select-none">{{ __('この本を選んだ理由') }}</label>
                <div class="col-md-7">
                    <textarea id="story" type="text" class="form-control" name="story"
                        rows="4">{{ $login_user->story }}</textarea>
                </div>
            </div>

            <div class="form-group row py-3 mb-0">
                <div class="col-md-7 offset-md-4 d-flex justify-content-between">
                    <button type="button" onclick="history.back()" class="btn btn-secondary rounded-pill">キャンセル</button>
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm">更新する</button>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection
