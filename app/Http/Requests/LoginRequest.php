<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorize to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email",
            "password" => "required",
            "remember_me" => "nullable"
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib di isi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak di temukan dalam data pengguna',
            'password.required' => 'Kata sandi wajib di isi',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return ResponseHelper::error($validator->errors(), trans('alert.validation_errors'));
    }
}
