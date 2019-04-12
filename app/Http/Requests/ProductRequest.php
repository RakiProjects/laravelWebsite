<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name|min:2',
            'description' => 'required|min:5',
            'alt' => 'min:2',
            'picture' => 'mimes:jpeg,jpg,png,gif|max:2000',
            'size' => 'required|min:2',
            'price' => 'required|numeric',
        ];
    }
}
