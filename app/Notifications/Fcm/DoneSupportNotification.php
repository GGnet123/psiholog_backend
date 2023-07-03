<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Support;
use Illuminate\Notifications\Notification;

class DoneSupportNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Support $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Your request has been processed by the support team, please wait for a response!',
            'Ваш запрос обработан службой поддержки, ожидайте ответ! ',
            'support',
            'done',
            $item->id
        );
    }

}
