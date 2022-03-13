<?php

namespace App\Listeners;

use App\Events\ApprovedRecordEvent;
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
        //
    }
}
