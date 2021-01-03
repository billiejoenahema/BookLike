<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
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
        return [
            'asin' => 'required',
            'page_url' => 'string',
            'title' => 'required',
            'author' => 'string | nullable',
            'manufacturer' => 'string | nullable',
            'image_url' => 'required',
            'text' => 'required | string | max:800'
        ];
    }
}
