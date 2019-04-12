<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' =>'required|regex:/^[A-Za-z][A-Za-z0-9\-\.\_]{2,}$/|unique:users,username',
            'email' =>'required|email|unique:users,email|max:60',
            'password' =>'required|string|min:4|confirmed',
        ];
    }
}
