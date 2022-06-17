<?php

namespace App\Http\Requests\Finance;

use Illuminate\Foundation\Http\FormRequest;

class CreateCreditCardRequest extends FormRequest
{
    public function rules()
    {
        return [
            'card_crypto' => 'required|string',
            'ip_address' => 'required|ip',
            'email' => 'required|email',
            'first_symbol' => 'required|string|size:2',
            'last_symbol' => 'required|string|size:2'
        ];
    }
}
