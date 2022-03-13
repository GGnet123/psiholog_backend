<?php

namespace App\Listeners;

use App\Events\ApprovedRecordEvent;
use App\Events\CreateRecordEvent;
use App\Models\Record\RecordLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApprovedRecordLogListner
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
     * @param  \App\Events\ApprovedRecordEvent  $event
     * @return void
     */
    public function handle(CreateRecordEvent $event)
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
