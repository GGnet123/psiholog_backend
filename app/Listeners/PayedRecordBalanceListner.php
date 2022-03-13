<?php

namespace App\Listeners;

use App\Events\PayedRecordEvent;
use App\Models\Main\Balancer;
use App\Models\Record\RecordLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayedRecordBalanceListner
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

        $balance->update(['is_done' => true]);
    }
}
