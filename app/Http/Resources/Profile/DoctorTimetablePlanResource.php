<?php
namespace App\Http\Resources\Profile;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorTimetablePlanResource extends JsonResource {
    public function toArray($request)
    {
        return [
            'day_01' => $this->day_01,
            'day_02' => $this->day_02,
            'day_03' => $this->day_03,
            'day_04' => $this->day_04,
            'day_05' => $this->day_05,
            'day_06' => $this->day_06,
            'day_07' => $this->day_07,
            'hour_00' => $this->hour_00,
            'hour_01' => $this->hour_01,
            'hour_02' => $this->hour_02,
            'hour_03' => $this->hour_03,
            'hour_04' => $this->hour_04,
            'hour_05' => $this->hour_05,
            'hour_07' => $this->hour_07,
            'hour_08' => $this->hour_08,
            'hour_09' => $this->hour_09,
            'hour_10' => $this->hour_10,
            'hour_11' => $this->hour_11,
            'hour_12' => $this->hour_12,
            'hour_13' => $this->hour_13,
            'hour_14' => $this->hour_14,
            'hour_15' => $this->hour_15,
            'hour_16' => $this->hour_16,
            'hour_17' => $this->hour_17,
            'hour_18' => $this->hour_18,
            'hour_19' => $this->hour_19,
            'hour_20' => $this->hour_20,
            'hour_21' => $this->hour_21,
            'hour_22' => $this->hour_22,
            'hour_23' => $this->hour_23
        ];
    }
}