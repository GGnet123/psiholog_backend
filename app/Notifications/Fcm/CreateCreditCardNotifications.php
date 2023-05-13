<?php

namespace App\Notifications\Fcm;

use App\Models\Finance\CreditCard;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCreditCardNotifications extends Notification {
    use NotifyFcmTrait;

    public function __construct(CreditCard $card) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Your card has been successfully linked, congratulations!',
            'Ваша карта успешно привязана, поздравляем!',
            'credit_cart',
            'create',
            $card->id
        );
    }

}
