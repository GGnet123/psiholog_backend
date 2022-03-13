<?php

namespace App\Listeners;

use App\Events\PayedRecordEvent;
use App\Models\Record\RecordLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayedRecordRecordLogListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PayedRecordEvent  $event
     * @return void
     */
    public function handle(PayedRecordEvent $event)
    {
        $record = $event->record;
        $user = $event->user;

        RecordLog::create([
            'record_id' => $record->id,
            'status_id' => $record->status_id,
            'is_moved' => false,
            'is_canceled' => false,
            'user_id' => $user->id,
            'record_json' => $record->toJson()
        ]);
    }
}
