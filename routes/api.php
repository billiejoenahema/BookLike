<?php

Route::group(['middleware' => 'auth'], function() {

    // 書籍検索（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('/reviews/search_items', 'Api\SearchItemsController')->name('search_items');

    // 投稿関連
    Route::resource('/reviews', 'Api\ReviewController', ['only' => ['index', 'show']]);

    // ユーザー関連
    Route::resource('/users', 'Api\UsersController', ['only' => ['index', 'show']]);

    // いいね機能
    Route::post('/add_favorite/{id}', 'Api\FavoriteController@addFavorite');
    Route::post('/remove_favorite/{id}', 'Api\FavoriteController@removeFavorite');

    // フォロー/フォロー解除
    Route::post('/follow/{id}', 'Api\FollowController@follow');
    Route::post('/unfollow/{id}', 'Api\FollowController@unfollow');

});
