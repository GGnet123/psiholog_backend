<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CancelRecordBySystemNotification;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCancelRecordBySystem
{

    public function handle(\App\Events\CancelRecordBySystemEvent $event)
    {
        $record = $event->record;
        $customer = $record->relCustomer;

        if ($customer && $customer->fcm_token && $customer->notify_all){
            $customer->notify(new CancelRecordBySystemNotification($record));
        }

        $doctor = $record->relDoctor;
        if ($doctor && $doctor->fcm_token && $doctor->notify_all){
            $doctor->notify(new CancelRecordBySystemNotification($record));
        }
    }
}
