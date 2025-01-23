<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId, // Unique email, excluding the current user
            'no_telp' => 'required',
            'password' => 'nullable|min:8|confirmed', // Password is nullable (for when not changing) and requires confirmation
            'alamat' => 'required',
            'kode_pos' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'no_telp.required' => 'No. Telepon is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'alamat.required' => 'Alamat is required.',
            'kode_pos.required' => 'Kode Pos is required.',
            'kelurahan.required' => 'Kelurahan is required.',
            'kecamatan.required' => 'Kecamatan is required.',
        ];
    }
}
