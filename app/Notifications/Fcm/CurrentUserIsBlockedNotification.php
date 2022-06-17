<?php

namespace App\Notifications\Fcm;

use App\Models\User;
use Illuminate\Notifications\Notification;

class CurrentUserIsBlockedNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(User $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Your access to online sessions has been blocked, please contact support!',
            'Ваш доступ к онлайн сессиям заблокирован, обратитесь в службу поддержки! ',
            'user',
            'blocked',
            $item->id
        );
    }

}
