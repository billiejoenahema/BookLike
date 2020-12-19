<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_name',
        'name',
        'profile_iamge',
        'email',
        'password',
        'description',
        'category'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ログインユーザーを除くすべてのユーザーを取得
    public function getAllUsers(Int $user_id)
    {
        return $this->where('id', '<>', $user_id)
                    ->with(['followers', 'reviews' => function($query) {
                        $query->with('favorites');
                        }])
                    ->withCount('followers');
    }

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()
        ->where('followed_id', $user_id)
        ->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()
        ->where('following_id', $user_id)
        ->first(['id']);
    }

    public function updateProfile(Array $params)
    {
        if (isset($params['profile_image'])) {
            $profile_image = Storage::disk('s3')->put('/', $params['profile_image'], 'public');
            $this::where('id', $this->id)->update(
                [
                'screen_name'   => $params['screen_name'],
                'name'          => $params['name'],
                'profile_image' => $profile_image,
                'category'      => $params['category'],
                'description'   => $params['description'],
                'asin'          => $params['asin'],
                'story'         => $params['story'],
                'email'         => $params['email'],
                ]);
        } else {
            $this::where('id', $this->id)->update(
            [
                'screen_name'   => $params['screen_name'],
                'name'          => $params['name'],
                'category'      => $params['category'],
                'description'   => $params['description'],
                'asin'          => $params['asin'],
                'story'         => $params['story'],
                'email'         => $params['email'],
            ]);
        }
        return;
    }

    // フォロー中のユーザーを取得
    public function getFollowingUsers(Int $id)
    {
        return $this->follows()
            ->with(['followers', 'reviews'=> function($query) {
                $query->with('favorites');
                }])
            ->where('following_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    // フォロワーを取得
    public function getFollowers(Int $id)
    {
        return $this->followers()
            ->with(['followers', 'reviews'=> function($query) {
                $query->with('favorites');
                }])
            ->where('followed_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    // ユーザー一覧の並び替え
    public function sortedUsers($sort, $pagination, $loginUserId)
    {
        switch ($sort) {
            case 'follower':
                // フォロワーが多い順にユーザーを取得
                return $this->getAllUsers($loginUserId)
                            ->orderBy('followers_count', 'DESC')
                            ->paginate($pagination);
                break;

            case 'default':
            default :
                // updated_at順にユーザーを取得
                return $this->getAllUsers($loginUserId)
                ->orderBy('updated_at', 'DESC')
                ->paginate($pagination);
                break;
        }
    }

}
