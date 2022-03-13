<?php

namespace App\Http\Resources\Main;

use App\Http\Resources\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->relUser ? new SimpleUserResource($this->relUser) : null,
            'is_active' => $this->is_active,
            'date_e' => $this->date_e,
            'by_month' => $this->by_month,
            'by_year' => $this->by_year,
            'created_at' => $this->created_at
        ];
    }
}
