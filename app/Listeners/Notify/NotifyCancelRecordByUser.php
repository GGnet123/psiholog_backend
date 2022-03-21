<?php

namespace App\Listeners\Notify;

use App\Events\CreateRecordCardEvent;
use App\Notifications\Fcm\CancelRecordByUserNotification;
use App\Notifications\Fcm\CreateCreditCardNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCancelRecordByUser
{

    public function handle(CreateRecordCardEvent $event)
    {
        $record = $event->record;

        $doctor = $record->relDoctor;
        if ($doctor && $doctor->fcm_token && $doctor->notify_all){
            $doctor->notify(new CancelRecordByUserNotification($record));
        }
    }
}
