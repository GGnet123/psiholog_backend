<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Support;
use Illuminate\Notifications\Notification;

class DoneSupportNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Support $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'support',
            'done',
            $item->id
        );
    }

}
