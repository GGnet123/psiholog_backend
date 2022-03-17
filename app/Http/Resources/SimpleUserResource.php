<?php

namespace App\Http\Resources;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
{
    public function toArray($request)
    {

        return  [
            'id' => $this->id,
            'name' => $this->name,
            'date_b' => $this->date_b,
            'is_blocked_seance' => $this->is_blocked_seance,
            'avatar' => ($this->relAvatar ? new UploaderFileResource($this->relAvatar) : null),
        ];
    }

}
