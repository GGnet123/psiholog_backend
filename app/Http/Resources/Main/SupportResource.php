<?php

namespace App\Http\Resources\Main;

use App\Http\Resources\Services\UploaderFileResource;
use App\Http\Resources\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->id,
            'note' => $this->id,
            'file_id' => $this->relFile ? new UploaderFileResource($this->relFile) : null,
            'from_user' => $this->relFromUser ? new SimpleUserResource($this->relFromUser) : null,
            'is_closed' => $this->is_closed,
            'answer' => $this->answer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
