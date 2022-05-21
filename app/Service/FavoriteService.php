<?php

namespace App\Services;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FavoriteService
{
    public $timestamps = false;

    /**
     * いいねしているかどうかを返す。
     */
    public function isFavorite(User $user, Int $review_id)
    {
        return (boolean) $this->where('user_id', $user->id)
            ->where('review_id', $review_id)
            ->first();
    }
    /**
     * レビューにいいねをする。
     */
    public function attachFavorite(User $user, Int $review_id)
    {
        DB::transaction(function () use ($user, $review_id) {
            $favorite = new Favorite;
            $favorite->user_id = $user->id;
            $favorite->review_id = $review_id;
            $favorite->save();
            return;
        });
    }
}
