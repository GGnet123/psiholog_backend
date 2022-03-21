<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use Illuminate\Notifications\Notification;

class PaedSubscriptoinNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Subscription $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'subscription',
            'payed',
            $item->id
        );
    }

}
