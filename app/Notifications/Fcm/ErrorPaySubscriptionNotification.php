<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Subscription;
use App\Models\User;
use Illuminate\Notifications\Notification;

class ErrorPaySubscriptionNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(User $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'There was a subscription payment error',
            'Произошла ошибка оплаты подписки',
            'subscription',
            'error_on_pay',
            $item->id
        );
    }

}
