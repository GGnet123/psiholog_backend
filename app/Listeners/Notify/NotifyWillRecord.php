<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\WillRecordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyWillRecord
{

    public function handle(CreateRecordCardEvent $event)
    {
        $record = $event->record;
        $customer = $record->relCustomer;

        if ($customer && $customer->fcm_token && $customer->notify_all && $customer->notify_app){
            $customer->notify(new WillRecordNotification($record));
        }
    }
}
