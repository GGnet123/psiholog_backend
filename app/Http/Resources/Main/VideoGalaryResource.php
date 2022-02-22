<?php

namespace App\Http\Resources\Main;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoGalaryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->trans('name'),
            'is_free' => $this->is_free,
            'photo' => $this->relPhoto ? new UploaderFileResource($this->relPhoto) : null,
            'cat' => $this->relCat ? new LibMusicGalaryResource($this->relCat) : null,
            'video' => $this->relVideo ? new UploaderFileResource($this->relVideo) : null
        ];
    }
}
