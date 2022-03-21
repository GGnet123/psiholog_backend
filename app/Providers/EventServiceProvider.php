<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\CreateRecordEvent;
use App\Events\ApprovedRecordEvent;
use App\Events\PayedRecordEvent;
use App\Events\StartSeanceRecordEvent;
use App\Events\FinishSeanceRecordEvent;
use App\Events\MoveSeanceRecordEvent;
use App\Events\CancelRecordEvent;

use App\Listeners\CreateRecordLogListner;
use App\Listeners\ApprovedRecordLogListner;
use App\Listeners\PayedRecordRecordLogListner;
use App\Listeners\StartSeanceRecordLogListner;
use App\Listeners\FinishSeanceRecordLogListner;
use App\Listeners\MoveSeanceRecordLogListner;
use App\Listeners\CancelRecordLogListner;


use App\Events\CreateSubscriptionEvent;
use App\Listeners\CreateSubscriptionBalancerLister;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CreateRecordEvent::class => [
            CreateRecordLogListner::class
        ],
        ApprovedRecordEvent::class => [
            ApprovedRecordLogListner::class
        ],
        PayedRecordEvent::class => [
            PayedRecordRecordLogListner::class
        ],
        StartSeanceRecordEvent::class => [
            StartSeanceRecordLogListner::class
        ],
        FinishSeanceRecordEvent::class => [
            FinishSeanceRecordLogListner::class
        ],
        MoveSeanceRecordEvent::class => [
            MoveSeanceRecordLogListner::class
        ],
        CancelRecordEvent::class => [
            CancelRecordLogListner::class
        ],
        CreateSubscriptionEvent::class => [
        ],
        \App\Events\CreateRecordCardEvent::class => [
            \App\Listeners\Notify\NotifyCreateRecordCardListner::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
