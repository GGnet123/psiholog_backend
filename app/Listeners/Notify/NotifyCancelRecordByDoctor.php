<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CancelRecordByDoctorNotification;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCancelRecordByDoctor
{

    public function handle(CreateRecordCardEvent $event)
    {
        $record = $event->record;
        $customer = $record->relCustomer;

        if ($customer && $customer->fcm_token && $customer->notify_all){
            $customer->notify(new CancelRecordByDoctorNotification($record));
        }

    }
}
