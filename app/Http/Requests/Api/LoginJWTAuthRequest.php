<?php
namespace App\Http\Requests\Api;

use \Illuminate\Foundation\Http\FormRequest;

class LoginJWTAuthRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'email' => 'required|max:100',
            'password' => 'required|max:200',
        ];
        return $rules;
    }
}