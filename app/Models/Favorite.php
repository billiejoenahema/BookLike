<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    // いいねしているかどうかの判定処理
    public function isFavorite(Int $user_id, Int $review_id)
    {
        return (boolean) $this->where('user_id', $user_id)
                              ->where('review_id', $review_id)
                              ->first();
    }

    public function storeFavorite(Int $user_id, Int $review_id)
    {
        $this->user_id = $user_id;
        $this->review_id = $review_id;
        $this->save();
        return;
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }


}
