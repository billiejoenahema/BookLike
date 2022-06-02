<?php

namespace App\Http\Requests\Review;

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
        if ($this->path() == 'reviews') {
            return true;
        }
        return false;
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
            case 'favorite':
                // いいね数
                return 'favorites_count';
            case 'ratings':
                // 評価
                return 'ratings';
            default:
                // 登録日
                return 'created_at';
        }
    }
}
