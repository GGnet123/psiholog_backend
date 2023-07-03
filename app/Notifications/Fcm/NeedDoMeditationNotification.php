<?php

namespace App\Notifications\Fcm;

use App\Models\Content\MainGalary;
use Illuminate\Notifications\Notification;

class NeedDoMeditationNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(MainGalary $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            'Take a meditation course with TalktoMe!',
            'Пройдите курс медитации вместе с TalktoMe! ',
            'meditation',
            'meditation',
            $item->id
        );
    }

}
