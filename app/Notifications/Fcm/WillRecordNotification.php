<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class WillRecordNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Within two days, money will be debited to renew the subscription!',
            'В течении двух дней пройдёт списание денег для продления подписки!',
            'record',
            'will_be_seance',
            $item->id
        );
    }

}
