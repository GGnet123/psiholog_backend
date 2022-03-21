<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\CurrentUserIsBlockedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCurrentUserIsBlocked
{

    public function handle(CreateRecordCardEvent $event)
    {
        $user = $event->user;

        if ($user && $user->fcm_token && $user->notify_all){
            $user->notify(new CurrentUserIsBlockedNotification($user));
        }
    }
}
