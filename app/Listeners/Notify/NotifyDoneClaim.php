<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\DoneClaimNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyDoneClaim
{

    public function handle(\App\Events\DoneClaimEvent $event)
    {
        $claim = $event->claim;
        $user = $claim->relUser;

        if ($user && $user->fcm_token && $user->notify_all) {
            $user->notify(new DoneClaimNotification($claim));
        }

        $user = $claim->relFromUser;
        if ($user && $user->fcm_token && $user->notify_all) {
            $user->notify(new DoneClaimNotification($claim));
        }
    }
}
