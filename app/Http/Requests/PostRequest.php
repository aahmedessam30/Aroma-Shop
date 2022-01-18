<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'title'   => ['required', 'string'],
                'content' => ['required', 'string'],
                'image'   => ['image', 'nullable'],
                'post_category_id' => ['required']
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'title'   => ['sometimes', 'string'],
                'content' => ['sometimes', 'string'],
                'image'   => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ];
        }
    }
}
