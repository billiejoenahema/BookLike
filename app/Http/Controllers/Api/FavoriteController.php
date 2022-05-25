<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * レビューにいいねする。
     *
     * @param  Int $review_id
     * @return array<string, string>
     */
    public function attach(Int $review_id)
    {
        $favoriteService = new FavoriteService;
        $is_favorite = $favoriteService->isFavorite($review_id);

        if (!$is_favorite) {
            $favoriteService->attachFavorite($review_id);
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }

    /**
     * レビューを削除する。
     *
     * @param  int  $review_id
     * @return array<string, string>
     */
    public function detach(Int $review_id)
    {
        $loginUser = Auth::user();
        $favoriteService = new FavoriteService;
        $is_favorite = $favoriteService->isFavorite($review_id);
        $favorite_id = Favorite::where('user_id', $loginUser->id)->where('review_id', $review_id)->value('id');

        if ($is_favorite) {
            $favoriteService->detachFavorite($favorite_id);
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }
}
