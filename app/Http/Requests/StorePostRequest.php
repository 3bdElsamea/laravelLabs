<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxPostsPerUser;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // Validate store
            'title' => 'required|min:3|unique:posts,title|max:250',
            'content' => 'required|min:10|max:250',
            // validat user using max post validation
            'user_id' => ['required', 'exists:users,id', new MaxPostsPerUser],
        ];
    }

    // Custom Messages
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'title.max' => 'Title must be less than 250 characters',
            'title.unique' => 'Title already exists',
            'content.required' => 'Content is required',
            'content.min' => 'Content must be at least 10 characters',
            'content.max' => 'Content must be less than 250 characters',
            'user_id.required' => 'User is required',
            'user_id.exists' => 'User does not exist',
        ];
    }
}
