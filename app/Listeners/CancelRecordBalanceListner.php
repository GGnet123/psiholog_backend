<?php

namespace App\Listeners;

use App\Events\CancelRecordEvent;
use App\Events\CreateRecordEvent;
use App\Models\Main\Balancer;
use App\Models\Record\RecordLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CancelRecordBalanceListner
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
     * @param  \App\Events\CancelRecordEvent  $event
     * @return void
     */

    public function handle(CancelRecordEvent $event)
    {
        $record = $event->record;
        $user = $event->user;

        $balance = Balancer::where(['user_id' => $user->id, 'record_id' => $record->id])->first();
        if (!$balance)
            $balance = Balancer::create([
                'is_done' => false,
                'is_canceled' => false,
                'user_id' => $user->id,
                'sum' => $record->sum,
                'record_id' => $record->id,
                'need_returned' => false,
                'is_returned' => false
            ]);

        $balance->update(['is_canceled' => true, 'need_returned' => true]);
    }
}
