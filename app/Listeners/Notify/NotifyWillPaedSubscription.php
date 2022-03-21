<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\WillPaedSubscriptionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyWillPaedSubscription
{

    public function handle(CreateRecordCardEvent $event)
    {
        $subscription = $event->subscription;
        $customer = $subscription->relUser;

        if ($customer && $customer->fcm_token && $customer->notify_all){
            $customer->notify(new WillPaedSubscriptionNotification($subscription));
        }
    }
}
