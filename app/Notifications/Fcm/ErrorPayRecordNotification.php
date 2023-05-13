<?php

namespace App\Notifications\Fcm;

use App\Models\Record\RecordDoctor;
use App\Models\User;
use Illuminate\Notifications\Notification;

class ErrorPayRecordNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(User $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'There was a payment error for an online session of a psychologist',
            'Произошла ошибка оплаты  на онлайн сессия психолога',
            'record',
            'error_on_pay',
            $item->id
        );
    }

}
