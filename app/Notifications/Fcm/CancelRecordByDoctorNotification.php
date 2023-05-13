<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class CancelRecordByDoctorNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'The appointment was canceled by a psychologist, try to make an appointment for another time or to another specialist!',
            ' Запись была отменена со стороны психологом, попробуйте записаться на другое время или к другому специалисту! ',
            'record',
            'cancel_by_doctor',
            $item->id
        );
    }

}
