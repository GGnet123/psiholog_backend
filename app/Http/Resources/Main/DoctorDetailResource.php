<?php
namespace App\Http\Resources\Main;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'date_b' => $this->date_b,
            'note' => $this->note,
            'avatar' => ($this->relAvatar ? new UploaderFileResource($this->relAvatar) : null),
            'price' => $this->price,
            'specializations' => LibSpecializationResource::collection($this->relSpecilizationMain),
            'certificats' => UploaderFileResource::collection($this->relCertificatsMain),
            'video' => UploaderFileResource::collection($this->relVideoMain),
        ];
    }
}
