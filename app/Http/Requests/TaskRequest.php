<?php
namespace App\Http\Requests;

use \Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'title' => 'required|max:400|min:1',
            'description' => 'required|max:1200|min:1',
            'datetime' => 'required|date',
        ];
        return $rules;
    }
}