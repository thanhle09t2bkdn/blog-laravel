<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
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
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|min:5|max:50|unique:\App\Models\User,email',
            'password' => 'required|min:6|max:50|confirmed',
            'role' => 'required|in:' . implode(',', array_keys(User::$roleNames)),
        ];
    }
}
