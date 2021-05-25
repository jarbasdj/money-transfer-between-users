<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'document' => 'required|unique:users',
            'type' => 'required|in:customer,store',
            'balance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'password' => 'required'
        ];
    }
}
