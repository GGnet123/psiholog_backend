<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use Illuminate\Notifications\Notification;

class PaedSubscriptoinNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Subscription $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Subscription payment successful!',
            'Оплата подписки прошла успешно! ',
            'subscription',
            'payed',
            $item->id
        );
    }

}
