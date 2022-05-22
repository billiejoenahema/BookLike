<?php

namespace App\Services;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteService
{
    public $timestamps = false;

    /**
     * いいねしているかどうかを返す。
     */
    public function isFavorite(Int $review_id)
    {
        $loginUser = Auth::user();
        return (boolean) $this->where('user_id', $loginUser->id)
            ->where('review_id', $review_id)
            ->first();
    }
    /**
     * レビューにいいねをつける。
     */
    public function attachFavorite(Int $review_id)
    {
        $loginUser = Auth::user();
        DB::transaction(function () use ($loginUser, $review_id) {
            $favorite = new Favorite;
            $favorite->user_id = $loginUser->id;
            $favorite->review_id = $review_id;
            $favorite->save();
            return;
        });
    }

    /**
     * レビューのいいねを外す。
     */
    public function detachFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}
