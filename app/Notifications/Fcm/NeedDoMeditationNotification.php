<?php

namespace App\Notifications\Fcm;

use App\Models\Content\MainGalary;
use Illuminate\Notifications\Notification;

class NeedDoMeditationNotification extends Notification {
    use NotifyFcmTrait;

    public function __construct(MainGalary $item) {
        $this->setData(
            'title_en',
            'title_ru',
            'body_en',
            'body_ru',
            'meditation',
            'meditation',
            $item->id
        );
    }

}
