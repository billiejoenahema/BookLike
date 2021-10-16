<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
        return [
            'asin' => 'required',
            'page_url' => 'string',
            'title' => 'required',
            'author' => 'string | nullable',
            'manufacturer' => 'string | nullable',
            'image_url' => 'required',
            'ratings' => 'required | digits:1',
            'spoiler' => 'required | digits:1',
            'text' => 'nullable | string | max:800'
        ];
    }
}