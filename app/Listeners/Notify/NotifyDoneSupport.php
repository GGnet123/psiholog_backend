<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\DoneSupportNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyDoneSupport
{

    public function handle(CreateRecordCardEvent $event)
    {
        $support = $event->support;
        $user = $support->relFromUser;

        if (!$user || !$user->fcm_token || !$user->notify_all)
            return;

        $user->notify(new DoneSupportNotification($support));
    }
}
