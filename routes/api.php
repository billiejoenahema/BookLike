<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Follower;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth'], function() {

    Route::get('/reviews',function (Request $request, Review $review, User $user) {

        $timelines = Review::with('user')->with('comments')->with('favorites')->orderBy('created_at', 'DESC')->get();
        $populars = Review::withCount('favorites')->with('comments')->with('favorites')->with('user')->orderBy('favorites_count', 'DESC')->get();
        $loginUser = auth()->user();

        return response()->json(
            [
            'timelines' => $timelines,
            'populars' => $populars,
            'loginUser' => $loginUser
            ]);
    });

    Route::get('/users', function (Request $request, User $user, Follower $follower) {

        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);
        $allUsers = $user->getAllUsers($loginUserId)->with('followers')->orderBy('created_at', 'DESC')->get();

        return response()->json(
            [
                'loginUser' => $loginUser,
                'allUsers' => $allUsers
            ]);
    });

    Route::get('/users/{id}',function (Request $request, Review $review, User $user, Follower $follower, Int $id) {

        $loginUserId = auth()->user()->id;
        $loginUser = $user->with('followers')->find($loginUserId);

        // ユーザーの投稿
        $userReviews = $review->where('user_id', $id)
            ->with(['user', 'comments', 'favorites'])
            ->orderBy('created_at', 'DESC')
            ->get();

        // いいねした投稿
        $favoriteReviews = $review->getFavoriteReviews($id);

        // フォローしているユーザー
        // $followingUsers = $user->belongsToMany('App\Models\User', 'followers', 'following_id', 'followed_id')
        //     ->where('following_id', $id)
        //     ->get();
        $followingUsers = $follower->where('following_id', $id)->select('followers.followed_id')->get();

        // フォロワー
        $followers = $user->belongsToMany('App\Models\User', 'followers', 'followed_id', 'following_id')
            ->where('followed_id', $id)
            ->get();

        return response()->json(
            [
                'loginUser' => $loginUser,
                'userReviews' => $userReviews,
                'favoriteReviews' => $favoriteReviews,
                'followingUsers' => $followingUsers,
                'followers' => $followers
            ]);
    });

    Route::post('favorites', 'Api\FavoriteController@store');
    Route::delete('favorites/{id}', 'Api\FavoriteController@destroy');

    // フォロー/フォロー解除
    Route::post('users/{id}/follow', 'Api\UsersController@follow');
    Route::delete('users/{id}/unfollow', 'Api\UsersController@unfollow');

});
