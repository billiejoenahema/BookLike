<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class review extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(50);
    }

    public function getReviewCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    // 一覧画面
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(50);
    }

    // 詳細画面
    public function getReview(Int $review_id)
    {
        return $this->with('user')
                    ->where('id', $review_id)
                    ->first();
    }

    public function reviewStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->text = $data['text'];
        $this->save();

        return;
    }
}
