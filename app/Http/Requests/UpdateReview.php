<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReview extends FormRequest
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
            'ratings' => 'required | digits:1', // 桁数：1
            'spoiler' => 'required | digits:1', // 桁数：1
            'text'    => 'nullable | string | max:800',
        ];
    }
}
