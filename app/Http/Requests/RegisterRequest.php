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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|max:15|min:1|unique:users',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'required|max:255|email|min:6|unique:users',
            'password' => 'required|min:6|max:15',
            'birth_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password 6-15 characters.'
        ];
    }
}
