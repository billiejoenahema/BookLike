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
        'asin',
        'title',
        'image_url',
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
        return $this->with('user')
                    ->where('id', $review_id)
                    ->first();
    }

    public function postedAsin($asin, Int $user_id)
    {
        return $this->where('user_id', $user_id)->where('asin', $asin)->first('asin');
    }

    public function reviewStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->category = $data['category'];
        $this->asin = $data['asin'];
        $this->page_url = $data['page_url'];
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->manufacturer = $data['manufacturer'];
        $this->image_url = $data['image_url'];
        $this->text = $data['text'];
        $this->save();

        return;
    }

    public function getEditReview(Int $user_id, Int $review_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('id', $review_id)
                    ->first();
    }

    public function reviewUpdate(Int $review_id, Array $data)
    {
        $this->id = $review_id;
        $this->text = $data['text'];
        $this->update();

        return;
    }

    public function reviewDestroy(Int $user_id, Int $review_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('id', $review_id)
                    ->delete();
    }

    // ユーザーの投稿をすべて取得
    public function getUserReviews(Int $user_id)
    {
        return $this->where('user_id', $user_id)
                    ->with(['user', 'comments', 'favorites'])
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    // いいねした投稿を取得
    public function getFavoriteReviews(Int $user_id)
    {
        $favorite_reviews = $this->whereHas(
            'favorites', function($query) use ($user_id)
        {
            $query->where('user_id', $user_id);
        }
        )->with('user')->with('comments')->with('favorites')->get();

        return $favorite_reviews;
    }


}
