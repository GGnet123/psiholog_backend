<?php

namespace App\Http\Resources\Main;

use App\Http\Resources\Services\UploaderFileResource;
use App\Http\Resources\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'to_user' => $this->relUser ? new SimpleUserResource($this->relUser) : null,
            'note' => $this->note,
            'file' => $this->relFile ? new UploaderFileResource($this->relFile) : null,
        ];
    }
}
