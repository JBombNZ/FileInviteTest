<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'role' => Rule::in(['User', 'Guest'])
        ];
    }
    
    /**
     *
     */
    public function messages()
    {
        return [
            'name.required' => 'First Name field is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been registered.',
            'password.required' => 'Password field is required.',
            'password.confirmed' => 'Password does not match.',
            'role.required' => 'Please select a role',
        ];
    }
    
}
