<?php

namespace App\Http\Resources\Services;

use Illuminate\Http\Resources\Json\JsonResource;

class UploaderFileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
            'filesize' => $this->filesize,
            'filename' => $this->filename,
            'extension' => $this->extension,
            'title' => $this->title
        ];
    }
}
