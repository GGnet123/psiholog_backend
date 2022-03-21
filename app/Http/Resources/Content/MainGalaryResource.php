<?php

namespace App\Http\Resources\Content;

use App\Http\Resources\Services\UploaderFileResource;
use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class MainGalaryResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'cat' => ($this->relCat ? $this->relCat->title : null),
            'title' => $this->title,
            'slug' => $this->slug,
            'music' => ($this->relMusic ? new UploaderFileResource($this->relMusic) : null),
            'video' => ($this->relVideo ? new UploaderFileResource($this->relVideo) : null),
            'image' => ($this->relImage ? new UploaderFileResource($this->relImage) : null),
            'favorite' => Favorite::getFavorBool('galary_item', $this->id)
        ];
    }

}
