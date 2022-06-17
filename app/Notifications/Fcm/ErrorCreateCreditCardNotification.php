<?php

namespace App\Notifications\Fcm;

use App\Models\Finance\CreditCard;
use Illuminate\Notifications\Notification;

class ErrorCreateCreditCardNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(CreditCard $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'credit_card',
            'error_on_create',
            $item->id
        );
    }

}
