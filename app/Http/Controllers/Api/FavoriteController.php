<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;


class FavoriteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Favorite $favorite)
    {
        $user = auth()->user();
        $review_id = $request->review_id;
        $is_favorite = $favorite->isFavorite($user->id, $review_id);
        if(!$is_favorite) {
            $favorite->storeFavorite($user->id, $review_id);
            return response()->json($favorite->id);
        }
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite, $id)
    {
        $favorite_id = $favorite->find($id);
        if($favorite_id) {
            $favorite_id->delete();
        }
        return;

    }
}
