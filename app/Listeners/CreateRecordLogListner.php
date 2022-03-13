<?php

namespace App\Listeners;

use App\Events\CancelRecordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRecordLogListner
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
        //
    }
}
