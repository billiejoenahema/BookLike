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
}
