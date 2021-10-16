<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
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

    public function getComments(Int $review_id)
    {
        return $this->with('user')
            ->withTrashed()
            ->where('review_id', $review_id)
            ->get();
    }

    public function commentStore(Int $user_id, array $data)
    {
        $this->user_id = $user_id;
        $this->review_id = $data['review_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }

    public function commentDestroy(Int $comment_id)
    {
        return $this->where('id', $comment_id)
            ->delete();
    }
}