<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\ErrorPayRecordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyErrorPayRecord
{

    public function handle(\App\Events\ErrorErrorPayRecordEvent $event)
    {
        $customer = $event->user;

        if ($customer && $customer->fcm_token && $customer->notify_all){
            $customer->notify(new ErrorPayRecordNotification($customer));
        }
    }
}
