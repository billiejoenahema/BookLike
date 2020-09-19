<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Favorite;


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

    Route::get('/users/{id}',function (Request $request, Review $review, $id) {

        $user_id = $id;
        // $query = Favorite::where('user_id', $user_id);
        $loginUser = auth()->user();
        $userReviews = Review::where('user_id', $user_id)
            ->with('user')
            ->with('comments')
            ->with('favorites')
            ->orderBy('created_at', 'DESC')
            ->get();
        $favoriteReviews = $review->getFavoriteReviews($user_id);

        return response()->json(
            [
                'loginUser' => $loginUser,
                'userReviews' => $userReviews,
                'favoriteReviews' => $favoriteReviews
            ]);
    });

    Route::post('favorites', 'Api\FavoriteController@store');
    Route::delete('favorites/{id}', 'Api\FavoriteController@destroy');

});
