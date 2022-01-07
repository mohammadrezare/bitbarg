<?php
namespace App\Http\Requests\Api;

use \Illuminate\Foundation\Http\FormRequest;

class RegisterJWTAuthRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|max:200',
            'email' => 'required|max:200|unique:users,email',
            'password' => 'required|max:8',
        ];
        return $rules;
    }
}