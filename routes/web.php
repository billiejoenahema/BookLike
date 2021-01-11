<?php

use App\Models\User;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('/reviews');
    }
    return view('welcome');
});

// ゲストログイン用ルート
Route::get('guest', 'Auth\LoginController@guestUserLogin')->name('login.guest');

Auth::routes();

// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only'
    => ['index', 'show', 'edit', 'update', 'destroy']]);

    // レビュー入力画面（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews/post', 'ReviewController@post')->name('reviews.post');

    // レビュー関連
    Route::resource('reviews', 'ReviewController');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy']]);

    // 利用規約
    Route::get('terms', function(User $user) {
        $login_user = auth()->user();
        $storage = Storage::disk('s3');

        return view('/terms', compact('login_user', 'storage'));
    });

    // プライバシーポリシー
    Route::get('privacy', function(User $user) {
        $login_user = auth()->user();
        $storage = Storage::disk('s3');

        return view('/privacy', compact('login_user', 'storage'));
    });
});
