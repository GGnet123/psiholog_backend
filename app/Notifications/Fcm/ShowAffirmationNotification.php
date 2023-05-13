<?php

namespace App\Notifications\Fcm;

use App\Models\Content\MainGalary;
use Illuminate\Notifications\Notification;

class ShowAffirmationNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(MainGalary $item) {
        $this->setData(
            'TalktoMe',
            'TalktoMe',
            $item->notification_ru,
            $item->notification_en,
            'affirmation',
            'affirmation',
            $item->id
        );
    }

}
