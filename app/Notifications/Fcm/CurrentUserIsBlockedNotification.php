<?php

namespace App\Notifications\Fcm;

use App\Models\User;
use Illuminate\Notifications\Notification;

class CurrentUserIsBlockedNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(User $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'user',
            'blocked',
            $item->id
        );
    }

}
