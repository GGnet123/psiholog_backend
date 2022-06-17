<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use Illuminate\Notifications\Notification;

class WillPaedSubscriptionNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Subscription $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'subscription',
            'will_paed',
            $item->id
        );
    }

}
