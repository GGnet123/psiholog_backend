<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Events\MoveSeanceRecordEvent;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use App\Notifications\Fcm\RemovedRecordByUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyRemovedRecordByUser
{

    public function handle(MoveSeanceRecordEvent $event)
    {
        $record = $event->record;
        $customer = $record->relCustomer;

        if ($customer && $customer->fcm_token && $customer->notify_all){
            $customer->notify(new RemovedRecordByUserNotification($record));
        }
    }
}
