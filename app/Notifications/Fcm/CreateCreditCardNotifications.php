<?php

namespace App\Notifications\Fcm;

use App\Models\Finance\CreditCard;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCreditCardNotifications extends Notification {
    use NotifyFcmTrait;

    public function __construct(CreditCard $card) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'credit_cart',
            'create',
            $card->id
        );
    }

}
