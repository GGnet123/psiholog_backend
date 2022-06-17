<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class RemovedRecordByUserNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Changed the time of the online session on the part of the user!',
            'Изменено время онлайн сессии со стороны пользователя! ',
            'record',
            'removed_by_user',
            $item->id
        );
    }

}
