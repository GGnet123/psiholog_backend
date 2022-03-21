<?php

namespace App\Http\Resources\Content;

use App\Http\Resources\Services\UploaderFileResource;
use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class MainGalaryCatResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'image' => ($this->relImage ? new UploaderFileResource($this->relImage) : null),
            'count_el' => $this->relGalary()->count(),
            'favorite' => Favorite::getFavorBool('galary_cat', $this->id)
        ];
    }

}
