<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use App\Models\User;
use Illuminate\Notifications\Notification;

class ErrorPaySubscriptionNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(User $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'subscription',
            'error_on_pay',
            $item->id
        );
    }

}
