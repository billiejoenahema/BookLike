<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * 適用する「データ」ラッパー
     *
     * @var string
     */
    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'screen_name' => $this->screen_name,
            'name' => $this->name,
            'profile_image' => $this->profile_image,
            'description' => $this->description,
            'follows_count' => $this->follows_count,
            'followers_count' => $this->followers_count,
            'reviews_count' => $this->reviews_count,
            'follows' => $this->follows,
            'followers' => $this->followers,
            'reviews' => [
                $this->reviews,
                $this->favorites_count,
            ]
        ];
    }
}