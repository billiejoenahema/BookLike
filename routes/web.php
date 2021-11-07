<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 認証機能
// Auth::routes();
Auth::routes(['verify' => true]);

// ログイン＆ログアウト時のリダイレクト
Route::get('/', 'RootController');

// ゲストログイン用ルート
Route::get('guest', 'Auth\LoginController@guestUserLogin')->name('login.guest');

// ログイン中のルーティング
Route::group(['middleware' => ['auth', 'verified']], function () {

    // ユーザ関連
    Route::get('users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');

    // レビュー
    Route::get('reviews', 'ReviewController@index')->name('reviews.index');
    Route::post('reviews/post', 'ReviewController@post')->name('reviews.post');
    Route::get('reviews/{review}', 'ReviewController@show')->name('reviews.show');
    Route::get('reviews/{review}/edit', 'ReviewController@edit')->name('reviews.edit');

    // 利用規約
    Route::view('/terms', 'terms');

    // プライバシーポリシー
    Route::view('/privacy', 'privacy');
});