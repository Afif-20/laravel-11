<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determinate if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return  array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        $rules = [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        if ($this->isMethod('POST')) {
            // STORE
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|string|min:8';
        } else {
            // UPDATE
            $userId = $this->route('user')?->id;

            $rules['name'] = 'sometimes|string|max:255';
            $rules['email'] = 'sometimes|email|unique:users,email,' . $userId;
            $rules['password'] = 'sometimes|string|min:8';
        }
        
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib di isi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'email.required' => 'Email wajib di isi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.sometimes' => 'Kata sandi wajib di isi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal 8 karakter.',

            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat jpeg, png, atau jpg.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
    
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return ResponseHelper::error($validator->errors(), trans('alert.validation_errors'));
    }
}
