<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessLogin extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required",
            "password" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Email wajib diisi!",
            "email.email" => "Format email tidak valid!",
            "password.required" => "Password wajib diisi!",
            "password.min" => "Password minimal harus 6 karakter!"
        ];
    }
}
