<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth'], function() {

    Route::get('/reviews',function (Request $request, Review $review) {
        $timelines = Review::orderBy('created_at', 'DESC')->get();
        // $populars = Review::withCount('favorite')->orderBy('favorite_count', 'DESC')->get();
        return response()->json(['timelines' => $timelines]);
    });
});
