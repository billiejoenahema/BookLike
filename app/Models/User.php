<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
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
        'profile_image',
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

    public function favorites()
    {
        return $this->hasManyThrough(Favorite::class, Review::class, 'user_id', 'review_id');
    }

    /**
     * ユーザープロフィール編集
     *
     * @param object $request
     * @return void
     */
    public function updateProfile($request): void
    {
        if (isset($request->profile_image)) {
            $profile_image = Storage::disk('s3')->put('/', $request->profile_image, 'public');
            $this::where('id', $this->id)->update(
                [
                    'screen_name'   => $request->screen_name,
                    'name'          => $request->name,
                    'profile_image' => $profile_image,
                    'category'      => $request->category,
                    'description'   => $request->description,
                    'asin'          => $request->asin,
                    'story'         => $request->story,
                    'email'         => $request->email,
                ]
            );
        } else {
            // 画像ファイルが選択されていない場合の処理
            $this::where('id', $this->id)->update(
                [
                    'screen_name'   => $request->screen_name,
                    'name'          => $request->name,
                    'category'      => $request->category,
                    'description'   => $request->description,
                    'asin'          => $request->asin,
                    'story'         => $request->story,
                    'email'         => $request->email,
                ]
            );
        }
        return;
    }
}
