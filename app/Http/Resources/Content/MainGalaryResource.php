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
            'title_en' => $this->title_en,
            'slug' => $this->slug,
            'type' => $this->type,
            'need_subscription' => $this->need_subscription,
            'music' => $this->google_drive_music,
            'video' => $this->google_drive_video,
            'image' => ($this->relImage ? new UploaderFileResource($this->relImage) : null),
            'favorite' => Favorite::getFavorBool('galary_item', $this->id)
        ];
    }

}
