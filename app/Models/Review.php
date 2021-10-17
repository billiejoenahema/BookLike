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

    // 新規投稿
    public function reviewStore(Int $user_id, $request)
    {
        $this->user_id = $user_id;
        $this->category = $request->category;
        $this->asin = $request->asin;
        $this->page_url = $request->page_url;
        $this->title = $request->title;
        $this->author = $request->author;
        $this->manufacturer = $request->manufacturer;
        $this->image_url = $request->image_url;
        $this->ratings = $request->ratings;
        $this->spoiler = $request->spoiler;
        $this->text = $request->text;
        $this->save();

        return;
    }

    // 投稿をアップデート
    public function reviewUpdate($request)
    {
        $this->id = $request->review;
        $this->ratings = $request->ratings;
        $this->spoiler = $request->spoiler;
        $this->text = $request->text;
        $this->update();
        return;
    }

    // ユーザーの投稿をすべて取得
    public function getUserReviews(Int $user_id)
    {
        return $this->where('user_id', $user_id)
            ->with(['user:id,screen_name,name,profile_image', 'comments:id', 'favorites'])
            ->with(['user' => function ($query) {
                return $query->withCount(['reviews', 'followers', 'favorites']);
            }])
            ->withCount('comments')
            ->orderBy('created_at', 'DESC')
            ->get();
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

    // 投稿一覧の取得
    public function getReviews($request, $pagination)
    {
        $sort = $request['sort'];
        $category = $request['category'];
        $criteria = $request['criteria'];
        $search = $request['search'];

        // カテゴリーを選択していなければ該当するwhen文をスルー
        if ($category === 'default') $category = false;

        // 検索ワードが入力されていなければ該当するwhen文をスルー
        if ($search === NULL) $search = false;
        $searches = ['criteria' => $criteria, 'search' => $search];

        // すべての投稿を取得
        $allReviews = $this->when($category, function ($query, $category) {
            return $query->where('category', $category);
        })
            ->when($searches, function ($query, $searches) {
                $criteria = $searches['criteria'];
                $search = $searches['search'];
                return $query->where($criteria, 'LIKE', "%$search%");
            })
            ->with(['user' => function ($query) {
                return $query->withCount(['reviews', 'followers', 'favorites']);
            }])
            ->with(['comments:id', 'favorites'])
            ->withCount(['comments', 'favorites']);

        switch ($sort) {
            case 'favorite':
                // いいねが多い順に投稿を並び替え
                return $allReviews->orderBy('favorites_count', 'DESC')->paginate($pagination);
            case 'ratings':
                // 評価が高い順に投稿を並び替え
                return $allReviews->orderBy('ratings', 'DESC')->paginate($pagination);
            case 'default':
            default:
                // 登録順に投稿を並び替え（デフォルト）
                return $allReviews->orderBy('created_at', 'DESC')->paginate($pagination);
        }
    }
}
