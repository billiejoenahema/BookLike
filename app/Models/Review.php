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

    /**
     * 所有するユーザーを取得する。
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 紐づくいいねを取得する。
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * 紐づくコメントを取得する。
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * レビュー一覧をソートします。
     *
     * @param  string $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sortedReviews($sort)
    {
        $pagination = config('PAGINATION.USERS');

        switch ($sort) {
            case 'favorite':
                // いいねが多い順に投稿を並び替え
                return $this->orderBy('favorites_count', 'DESC')->paginate($pagination);
            case 'ratings':
                // 評価が高い順に投稿を並び替え
                return $this->orderBy('ratings', 'DESC')->paginate($pagination);
            default:
                // 登録順に投稿を並び替え（デフォルト）
                return $this->orderBy('created_at', 'DESC')->paginate($pagination);
        }
    }
}
