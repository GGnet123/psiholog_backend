<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class BuyCouponRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sum' => 'required|integer|min:10',
        ];
    }
}
