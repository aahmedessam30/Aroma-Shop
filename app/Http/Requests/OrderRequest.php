<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'           => ['required', 'string'],
            'phone'          => ['required', 'regex:/(01)[0-9]{9}/', 'numeric'],
            'email'          => ['required', 'email'],
            'country'        => ['required'],
            'address'        => ['required', 'string'],
            'city'           => ['required', 'string'],
            'zip'            => ['required', 'numeric'],
        ];
    }
}
