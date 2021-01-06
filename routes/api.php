<?php

Route::group(['middleware' => 'auth'], function() {

    // 書籍検索（resourceよりも上に書かないと'404 Not found'になってしまう）
    Route::get('reviews/search_items', 'Api\SearchItemsController')->name('search_items');

    Route::get('/reviews/{review}', 'Api\ReviewController@show');

    Route::get('/reviews', 'Api\ReviewController@index');

    Route::get('/users/{user}', 'Api\UsersController@show');

    Route::get('/users', 'Api\UsersController@index');

    // いいね機能
    Route::post('favorites', 'Api\FavoriteController@store');
    Route::delete('favorites/{id}', 'Api\FavoriteController@destroy');

    // フォロー/フォロー解除
    Route::post('follow/{id}', 'Api\FollowController@follow');
    Route::post('unfollow/{id}', 'Api\FollowController@unfollow');

});
