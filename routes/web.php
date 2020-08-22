<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('/reviews');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only'
    => ['index', 'show', 'edit', 'update', 'destroy']]);

    // フォローしているユーザーを一覧表示
    Route::get('users/{user}/following', 'UsersController@following')->name('users.following');

    // フォロワーを一覧表示
    Route::get('users/{user}/followers', 'UsersController@followers')->name('users.followers');

    // いいねしたレビューを一覧表示
    Route::get('users/{user}/favorite', 'UsersController@favorite')->name('users.favorite');

    // フォロー/フォロー解除
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    // 書籍検索
    Route::get('reviews/search_items', 'Api\SearchItemsController')->name('search_items');

    // レビュー新規投稿
    Route::resource('reviews', 'ReviewController');

    // レビュー入力画面
    Route::get('reviews/posts', 'ReviewController@posts')->name('reviews.posts');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy']]);

    // いいね関連
    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);


});
