<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class PayedRecordNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Payment for an online session with a psychologist was successful!',
            'Оплата онлайн сессии к психологу прошла успешно! ',
            'record',
            'payed',
            $item->id
        );
    }

}
