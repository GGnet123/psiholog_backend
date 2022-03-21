<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\ErrorCreateCreditCardNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyErrorCreateCreditCard
{

    public function handle(CreateRecordCardEvent $event)
    {
        $card = $event->card;
        $user = $card->relUser;

        if (!$user || !$user->fcm_token || !$user->notify_all)
            return;

        $user->notify(new ErrorCreateCreditCardNotification($card));
    }
}
