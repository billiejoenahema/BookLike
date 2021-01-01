@extends('layouts.app')

@section('content')
@include('components.back_button')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between">
        <div>プロフィールを編集</div>
        @if($login_user->id !== 1)
        <a href="#" class=" text-decoration-none text-danger" data-toggle="modal" data-target="#deleteComfirmModal"
            role="button" title="アカウント削除">
            <i class="fas fa-user-times"></i>
        </a>
        @endif
    </div>
    @if($login_user->id === 1)
    <div class="text-danger m-auto p-3">
        {{ __('ゲストユーザーはプロフィールを編集できません') }}
    </div>
    @endif
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
                    <input type="file" name="profile_image" class="small @error('profile_image') is-invalid @enderror"
                        autocomplete="profile_image">
                    @error('profile_image')
                    <span class="invalid-feedback small" role="alert">
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
                        @if($userReviews)
                        <option value="" default>{{ $book_title ?? '未設定' }}</option>
                        @foreach($userReviews as $userReview)
                        <option value="{{ $userReview->asin }}">{{ $userReview->title }}</option>
                        @endforeach
                        @else
                        <option value="" default>レビューを投稿してください</option>
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
                    @if($login_user->id == 1)
                    <button type="button" class="btn btn-primary rounded-pill shadow-sm disabled" disabled>更新する</button>
                    @else
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm">更新する</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <!-- Delete Account Confirm Modal -->
    <div class="modal fade" id="deleteComfirmModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteComfirmModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">本当にアカウントを削除しますか？</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>「削除する」ボタンを押すとあなたのアカウント情報はすべて消去されます</span>
                    <div class="form-group form-check mt-3 ml-2">
                        @if($login_user->id == 1)
                        <input type="checkbox" class="form-check-input" disabled>
                        <label class="form-check-label text-muted" for="deleteCheck">アカウントを完全に削除する</label>
                        <br />
                        <span class="text-danger">ゲストユーザーはアカウントを削除できません</span>
                        @else
                        <input type="checkbox" class="form-check-input" id="deleteCheck" onchange="deleteCheck()">
                        <label class="form-check-label" for="deleteCheck">アカウントを完全に削除する</label>
                        @endif
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary rounded-pill mr-3"
                        data-dismiss="modal">キャンセル</button>
                    <form method="POST" action="{{ route('users.destroy', $login_user->id) }}"
                        id="delete_{{ $login_user->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="deleteButton" class="btn btn-crimson rounded-pill disabled"
                            disabled>削除する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
