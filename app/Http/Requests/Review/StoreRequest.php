<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'category' => 'required | string | max:255',
            'asin' => 'required | string |size:10',
            'page_url' => 'nullable | string | max:255',
            'title' => 'required | string | max:255',
            'author' => 'nullable | string | max:255',
            'manufacturer' => 'nullable | string | max:255',
            'image_url' => 'required | string | url | max:255',
            'ratings' => 'required | digits:1 | between:1,5',
            'spoiler' => 'required | digits:1 | boolean',
            'text' => 'nullable | string | max:800',
        ];
    }
}
