<?php

namespace App\Http\Resources\Record;

use App\Http\Resources\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
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
            'id' => $this->id,
            'customer' =>  $this->relCustomer ? new SimpleUserResource($this->relCustomer) : null,
            'doctor' => $this->relDoctor ? new SimpleUserResource($this->relDoctor) : nul,
            'sum' => $this->sum,
            'record_date' => $this->record_date,
            'record_time' => $this->record_time,
            'status_id' => $this->status_id,
            'status_name' => $this->status_name,
            'is_canceled' => $this->is_canceled,
            'is_moved' => $this->is_moved,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }

}
