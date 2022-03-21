<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use App\Models\User;
use Illuminate\Notifications\Notification;

class ErrorPayRecordNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(User $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'record',
            'error_on_pay',
            $item->id
        );
    }

}
