<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->isDoctor())
            return $this->doctorResponse($request);

        if ($this->isUser())
            return $this->userResponse($request);

        if ($this->isNoteFinishRegistration())
            return $this->noteFinishResponse($request);

        return  [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'type' => 'admin'
        ];
    }

    private function noteFinishResponse($request){
        return  [
            'id' => $this->id,
            'login' => $this->login,
            'type' => 'note_finished'
        ];
    }

    private function doctorResponse($request){
        return  [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'lang' => $this->lang,
            'date_b' => $this->date_b,
            'avatar_id' => $this->avatar_id,
            'note' => $this->note,
            'price' => $this->price,
            'notify_all' => $this->notify_all,
            'notify_meditation' => $this->notify_meditation,
            'notify_app' => $this->notify_app,
            'type' => 'doctor'
        ];
    }

    private function userResponse($request){
        return  [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'lang' => $this->lang,
            'avatar_id' => $this->avatar_id,
            'notify_all' => $this->notify_all,
            'notify_meditation' => $this->notify_meditation,
            'notify_app' => $this->notify_app,
            'type' => 'user'
        ];
    }
}
