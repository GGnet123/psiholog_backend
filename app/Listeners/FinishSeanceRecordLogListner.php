<?php

namespace App\Listeners;

use App\Events\FinishSeanceRecordEvent;
use App\Models\Record\RecordLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FinishSeanceRecordLogListner
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
     * @param  \App\Events\FinishSeanceRecordEvent  $event
     * @return void
     */
    public function handle(FinishSeanceRecordEvent $event)
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
