<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateRequest extends FormRequest
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
    public function rules(User $user)
    {
        return [
            'screen_name' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($this->user)],
            'name' => ['nullable', 'string', 'max:50'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'category' => ['nullable', 'string', 'max:255'],
            'asin' => ['nullable', 'string', 'size:10'],
            'story' => ['nullable', 'string', 'max:800'],
            'description' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)]
        ];
    }
}
