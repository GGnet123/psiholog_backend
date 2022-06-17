<?php

namespace App\Http\Resources\Content;

use App\Http\Resources\Services\UploaderFileResource;
use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class MainGalaryCatFatResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'title' => $this->title,
            'title_en' => $this->title_en,
            'type' => $this->type,
            'need_subscription' => $this->need_subscription,
            'image' => ($this->relImage ? new UploaderFileResource($this->relImage) : null),
            'count_el' => $this->relGalary()->count(),
            'list_el' => MainGalaryResource::collection($this->relGalary),
            'favorite' => Favorite::getFavorBool('galary_cat', $this->id)
        ];
    }

}
