<?php

namespace App\Listeners;

use App\Events\ApprovedRecordEvent;
use App\Models\Main\Balancer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRecordBalanceListner
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
    public function handle(ApprovedRecordEvent $event)
    {
        $record = $event->record;
        $user = $event->user;

        $balance = Balancer::create([
            'is_done' => false,
            'is_canceled' => false,
            'user_id' => $user->id,
            'sum' => $record->sum,
            'record_id' => $record->id,
            'need_returned' => false,
            'is_returned' => false
        ]);
    }
}
