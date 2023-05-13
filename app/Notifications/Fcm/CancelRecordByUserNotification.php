<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class CancelRecordByUserNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'The entry has been canceled by the user!',
            'Запись была отменена пользователем!',
            'record',
            'cancel_by_user',
            $item->id
        );
    }

}
