<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use Illuminate\Notifications\Notification;

class WillPaedSubscriptionNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Subscription $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Within two days, money will be debited to renew the subscription!',
            'В в течении двух дней пройдёт списание денег для продления подписки!',
            'subscription',
            'will_paed',
            $item->id
        );
    }

}
