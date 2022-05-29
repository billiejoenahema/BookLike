<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'asin',
        'page_url',
        'title',
        'author',
        'manufacturer',
        'image_url',
        'ratings',
        'spoiler',
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 詳細画面
    public function getReview(Int $review_id)
    {
        return $this->with(['user' => function ($query) {
            return $query->withCount(['reviews', 'followers', 'favorites']);
        }])
            ->with(['comments:id', 'favorites'])
            ->withCount(['comments', 'favorites'])
            ->where('id', $review_id)
            ->first();
    }

    // 投稿済みかどうか
    public function isPosted($asin, Int $user_id)
    {
        return (bool) $this->where('user_id', $user_id)
            ->where('asin', $asin)
            ->first('asin');
    }

    // いいねした投稿を取得
    public function getFavoriteReviews(Int $user_id)
    {
        return $this->whereHas('favorites', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->with(['user:id,screen_name,name,profile_image', 'comments:id', 'favorites'])
            ->with(['user' => function ($query) {
                return $query->withCount(['reviews', 'followers', 'favorites']);
            }])
            ->withCount('comments')
            ->get();
    }
}
