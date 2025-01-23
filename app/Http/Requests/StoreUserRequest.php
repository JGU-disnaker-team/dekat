<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
        return [
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required|unique:students',
            'password' => 'required|same:repeatPassword|min:8|max:12',
            'repeatPassword' => 'required_with:password|min:8|max:12',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required'
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
            'nama.required' => 'Name is required.',
            'no_telp.required' => 'Phone Number is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'The Email is already registered.',
            'password.required' => 'Password is required.',
            'password.same' => 'Password and Repeat Password must be the same.',
            'password.min' => 'Password must be at least 8 characters.',
            'repeatPassword.required_with' => 'Repeat Password is required.',
            'repeatPassword.min' => 'Repeat Password must be at least 8 characters.',
            'alamat.required' => 'Address is required.',
            'kelurahan.required' => 'Sub-District is required.',
            'kecamatan.required' => 'District is required.',
            'kode_pos.required' => 'Postal Code is required.'
        ];
    }
}
