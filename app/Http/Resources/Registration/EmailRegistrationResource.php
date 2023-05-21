<?php

namespace App\Http\Resources\Registration;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
            'email' => $this->email,
//            'accepted' => $this->accepted,
            'pin' => $this->pin
        ];
    }
}
