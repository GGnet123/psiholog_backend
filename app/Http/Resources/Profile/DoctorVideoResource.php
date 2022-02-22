<?php
namespace App\Http\Resources\Profile;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorVideoResource extends JsonResource {
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'video' => $this->relVideo ? new UploaderFileResource($this->relVideo) : null
        ];
    }
}