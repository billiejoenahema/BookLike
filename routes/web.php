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
    Route::post('users/{user}', 'UserController@update')->name('users.update')->middleware('can:update,user');
    Route::post('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:delete,user');

    // レビュー入力画面（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews', 'ReviewController@index')->name('reviews.index');
    Route::get('reviews/post', 'ReviewController@post')->name('reviews.post');
    Route::get('reviews/store', 'ReviewController@store')->name('reviews.store');
    Route::get('reviews/show', 'ReviewController@show')->name('reviews.show');
    Route::get('reviews/{review}/edit', 'ReviewController@edit')->name('reviews.edit');
    Route::get('reviews/{review}/update', 'ReviewController@update')->name('reviews.update')->middleware('can:update,review');
    Route::get('reviews/destroy', 'ReviewController@destroy')->name('reviews.destroy')->middleware('can:delete,review');

    // レビュー関連
    Route::resource('reviews', 'ReviewController');

    // コメント関連
    Route::resource('comments', 'CommentController', ['only' => ['store', 'destroy']]);

    // 利用規約
    Route::view('/terms', 'terms');

    // プライバシーポリシー
    Route::view('/privacy', 'privacy');
});