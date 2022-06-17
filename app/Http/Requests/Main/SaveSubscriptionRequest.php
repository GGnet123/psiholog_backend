<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class SaveSubscriptionRequest extends FormRequest
{

    protected function prepareForValidation(){
        if ($this->by_month && is_string($this->by_month) && $this->by_month == 'true') {
            $this->merge([
                'by_month'  => true,
            ]);
        }

        if ($this->by_month && is_string($this->by_month) && $this->by_month == 'false') {
            $this->merge([
                'by_month'  => false,
            ]);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'by_month' => 'required|boolean'
        ];
    }
}
