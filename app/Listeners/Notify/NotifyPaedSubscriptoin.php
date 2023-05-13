<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\PaedSubscriptoinNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyPaedSubscriptoin
{

    public function handle(\App\Events\PaedSubscriptoinEvent $event)
    {
        $subscription = $event->subscription;
        $customer = $subscription->relUser;

        if ($customer && $customer->fcm_token && $customer->notify_all){
            $customer->notify(new PaedSubscriptoinNotification($subscription));
        }
    }
}
