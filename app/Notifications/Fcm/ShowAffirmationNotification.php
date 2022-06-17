<?php

namespace App\Notifications\Fcm;

use App\Models\Content\MainGalary;
use Illuminate\Notifications\Notification;

class ShowAffirmationNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(MainGalary $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'affirmation',
            'affirmation',
            $item->id
        );
    }

}
