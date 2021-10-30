<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResource extends JsonResource
{
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
            'story' => $this->story,
            'asin' => $this->asin,
            'category' => $this->category,
            'description' => $this->description,
            'email' => $this->email,
            'follows' => $this->follows,
            'followers' => $this->followers,
        ];
    }
}