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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|email|min:8|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|same:password_confirmation',
            'password_confirmation' => 'required|string|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Este e-mail já está cadastrado',
        ];
    }
}
