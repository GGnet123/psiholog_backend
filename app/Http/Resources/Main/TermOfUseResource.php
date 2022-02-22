<?php

namespace App\Http\Resources\Main;

use Illuminate\Http\Resources\Json\JsonResource;

class TermOfUseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'note' => $this->trans('note')
        ];
    }
}
