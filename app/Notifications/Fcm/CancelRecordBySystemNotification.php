<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class CancelRecordBySystemNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'The registration was canceled by the system, please check your bank card and try again!',
            'Запись была отменена со стороны системы, проверьте Вашу банковскую карту и повторите попытку! ',
            'record',
            'cancel_by_system',
            $item->id
        );
    }

}
