<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class CancelRecordByUserNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'record',
            'cancel_by_user',
            $item->id
        );
    }

}
