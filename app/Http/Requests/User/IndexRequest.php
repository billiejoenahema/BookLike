<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //
    }

    /**
     * ソートの対象となるカラムを返す。
     *
     * @param  string  $sort
     * @return string
     */
    public function getColumnForSort($sort)
    {
        switch ($sort) {
            case 'review':
                // 投稿数
                return 'reviews_count';
            case 'follower':
                // フォロワー
                return 'followers_count';
            case 'favorite':
                // いいね獲得数
                return 'favorites_count';
            default:
                // 登録日
                return 'created_at';
        }
    }
}
