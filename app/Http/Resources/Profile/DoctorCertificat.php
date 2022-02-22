<?php
namespace App\Http\Resources\Profile;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorCertificat extends JsonResource {
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'certificat' => $this->relCertificat ? new UploaderFileResource($this->relCertificat) : null
        ];
    }
}