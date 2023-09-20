<?php

namespace App\Http\Resources;

use App\Http\Resources\Services\UploaderFileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
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
            'is_blocked_seance' => $this->is_blocked_seance,
            'has_active_credit_card' => $this->hasActiveCreditCard(),
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
            'avatar' => ($this->relAvatar ? new UploaderFileResource($this->relAvatar) : null),
            'note' => $this->note,
            'price' => $this->price,
            'notify_all' => $this->notify_all,
            'notify_meditation' => $this->notify_meditation,
            'notify_app' => $this->notify_app,
            'doctor_credit_card' => $this->doctor_credit_card,
            'is_blocked_seance' => $this->is_blocked_seance,
            'has_active_credit_card' => $this->hasActiveCreditCard(),
            'specializations' => $this->relSpecilizationMain()->pluck('name')->toArray(),
            'card_data' => $this->card_data,
            'education' => $this->education,
            'type' => 'doctor',
            'therapy_methods' => $this->therapy_methods
        ];
    }

    private function userResponse($request){
        return  [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'lang' => $this->lang,
            'avatar' => ($this->relAvatar ? new UploaderFileResource($this->relAvatar) : null),
            'notify_all' => $this->notify_all,
            'notify_meditation' => $this->notify_meditation,
            'notify_app' => $this->notify_app,
            'is_blocked_seance' => $this->is_blocked_seance,
            'has_active_credit_card' => $this->hasActiveCreditCard(),
            'type' => 'user'
        ];
    }
}
