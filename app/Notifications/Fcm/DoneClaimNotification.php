<?php

namespace App\Notifications\Fcm;

use App\Models\Main\Claim;
use Illuminate\Notifications\Notification;

class DoneClaimNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(Claim $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Your complaint has been processed, please wait for a response!',
            'Ваша жалоба отработана,ожидайте ответ!',
            'claim',
            'done',
            $item->id
        );
    }

}
