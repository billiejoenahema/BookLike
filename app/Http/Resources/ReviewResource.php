<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * 適用する「データ」ラッパー
     *
     * @var string
     */
    public static $wrap = 'review';

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
            'user_id' => $this->user_id,
            'category' => $this->category,
            'asin' => $this->asin,
            'page_url' => $this->page_url,
            'title' => $this->title,
            'author' => $this->author,
            'manufacturer' => $this->manufacturer,
            'image_url' => $this->image_url,
            'text' => $this->text,
            'ratings' => $this->ratings,
            'spoiler' => $this->spoiler,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'favorites_count' => $this->favorites_count,
            'favorites' => $this->favorites,
            'comments' => CommentResource::collection($this->comments),
            'user' => new UserResource($this->user),
        ];
    }
}
