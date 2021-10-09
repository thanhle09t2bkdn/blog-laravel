<?php


namespace App\Http\Requests\Posts;


use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
     * @param Post $post
     *
     * @return array
     */
    public function rules(Post $post)
    {
        return [
            'title' => 'required|min:3|max:255',
            'categories' => 'required',
            'categories.*' => 'exists:App\Models\Category,id',
            'content' => 'required',
            'image' => 'required|max:255',
        ];
    }
}
