<?php

namespace App\Notifications\Fcm;

use App\Models\Finance\CreditCard;
use Illuminate\Notifications\Notification;

class ErrorCreateCreditCardNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(CreditCard $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'There was an error linking a bank card!',
            'Произошла ошибка привязки банковской карты!',
            'credit_card',
            'error_on_create',
            $item->id
        );
    }

}
