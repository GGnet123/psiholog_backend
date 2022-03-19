<?php

namespace App\Http\Resources\Finance;

use App\Http\Resources\Services\UploaderFileResource;
use App\Http\Resources\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_accepted' => $this->is_accepted,
            'is_3d_secure' => $this->is_3d_secure,
            'is_active' => $this->is_active,
            'is_removed' => $this->is_removed,
            'note' => $this->note,
            'first_symbol' => $this->first_symbol,
            'last_symbol' => $this->last_symbol,
            'email' => $this->email,
            'data_to_check_3d_secure' => ($this->is_active || $this->is_removed || $this->is_accepted ? null : $this->data_to_check_3d_secure),
        ];
    }
}
