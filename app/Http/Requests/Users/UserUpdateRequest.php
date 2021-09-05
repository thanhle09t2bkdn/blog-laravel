<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserUpdateRequest extends FormRequest
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
     * @param User $user
     *
     * @return array
     */
    public function rules(User $user)
    {
        $params = Route::current()->parameters();
        $id = $params['user'];

        $rules = $user->rules();

        $rules['email'] = 'required|email|min:5|max:50|unique:\App\Models\User,email,' . $id;
        $rules['password'] = 'nullable|min:6|max:50|confirmed';

        return $rules;
    }
}
