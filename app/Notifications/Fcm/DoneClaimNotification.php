<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Claim;
use Illuminate\Notifications\Notification;

class DoneClaimNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Claim $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'claim',
            'done',
            $item->id
        );
    }

}
