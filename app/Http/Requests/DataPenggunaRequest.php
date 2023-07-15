<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DataPenggunaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'unique:users',
            // 'username' => 'required|unique:users',
            'roles' => 'required',
            // 'name' => 'required',
            // 'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            // 'email.required' => 'Email Wajib Di Isi',
            'roles.required' => 'Role Wajib Di Isi',
            'name.required' => 'Nama Wajib Di Isi',
            'password.required' => 'Kata Sandi Wajib Di Isi',
            'email.unique' => 'Email Sudah Ada',
            'username.unique' => 'Username Sudah Ada',
            'password.min' => 'Minimal 6 Karakter',
           
            
        ];
    }
}
