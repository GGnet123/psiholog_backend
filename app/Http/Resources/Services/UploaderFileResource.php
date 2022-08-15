<?php

namespace App\Http\Resources\Services;

use App\Models\Services\UploaderFile;
use Illuminate\Http\Resources\Json\JsonResource;

class UploaderFileResource extends JsonResource
{
    public function toArray($request)
    {
        $ar =  [
            'id' => $this->id,
            'path' => $this->path,
            'filesize' => $this->filesize,
            'filename' => $this->filename,
            'extension' => $this->extension,
            'title' => $this->title
        ];

        if ($this->type_id == UploaderFile::DROPBOX)
            $ar['type'] = 'dropbox';
        else
            $ar['type'] = 'main';

        return $ar;
    }
}
