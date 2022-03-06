<?php

namespace App\Http\Requests\Profile\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSaveTimetablePlanRequest extends FormRequest
{
    protected function prepareForValidation(){
        for ($i = 1; $i <= 7; $i ++){
            if ($this->{'day_0'.$i} && is_string($this->{'day_0'.$i}) && $this->{'day_0'.$i} == 'true'){
                $this->merge([
                    'day_0'.$i => true,
                ]);
            }

            if ($this->{'day_0'.$i} && is_string($this->{'day_0'.$i}) && $this->{'day_0'.$i} == 'false'){
                $this->merge([
                    'day_0'.$i => false,
                ]);
            }
        }

        for ($i = 0; $i <= 23; $i ++){
            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);

            if ($this->{'hour_'.$i_str} && is_string($this->{'hour_'.$i_str}) && $this->{'hour_'.$i_str} == 'true'){
                $this->merge([
                    'hour_'.$i_str => true,
                ]);
            }

            if ($this->{'hour_'.$i_str} && is_string($this->{'hour_'.$i_str}) && $this->{'hour_'.$i_str} == 'false'){
                $this->merge([
                    'hour_'.$i_str => false,
                ]);
            }
        }




    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $ar_valid = [];
        for ($i = 1; $i <= 7; $i ++){
            $ar_valid['day_0'.$i] = 'required|boolean';
        }

        for ($i = 0; $i <= 23; $i ++){
            $i_str = str_pad($i, 2, '0', STR_PAD_LEFT);
            $ar_valid['hour_'.$i_str] = 'required|boolean';
        }

        return $ar_valid;
    }
}
