<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'from' => 'required|int',
            'to' => 'required|int'
        ];
    }
}
