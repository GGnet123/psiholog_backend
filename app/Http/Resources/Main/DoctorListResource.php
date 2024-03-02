<?php
namespace App\Http\Resources\Main;

use App\Http\Resources\Services\UploaderFileResource;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorListResource extends JsonResource
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
//            'certificats' => UploaderFileResource::collection($this->relCertificatsMain),
//            'video' => UploaderFileResource::collection($this->relVideoMain),
            'favorite' => Favorite::getFavorBool('doctor', $this->id),
            'therapy_methods' => $this->therapy_methods,
            'experience' => $this->experience,
            'closest_open_window' => $this->getClosestOpenDateTime()
        ];
    }
}
