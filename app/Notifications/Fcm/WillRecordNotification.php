<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use App\Models\Record\RecordDoctor;
use Illuminate\Notifications\Notification;

class WillRecordNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(RecordDoctor $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'record',
            'will_be_seance',
            $item->id
        );
    }

}
