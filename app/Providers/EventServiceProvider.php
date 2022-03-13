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
use App\Listeners\SendShipmentNotification;
use App\Listeners\CreateRecordLogListner;
use App\Listeners\CreateRecordBalanceListner;
use App\Listeners\UpdateRecordBalanceListner;


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
            CreateRecordLogListner::class,
            CreateRecordBalanceListner::class
        ],
        PayedRecordEvent::class => [
            CreateRecordLogListner::class,
            UpdateRecordBalanceListner::class
        ],
        StartSeanceRecordEvent::class => [
            CreateRecordLogListner::class
        ],
        FinishSeanceRecordEvent::class => [
            CreateRecordLogListner::class
        ],
        MoveSeanceRecordEvent::class => [
            CreateRecordLogListner::class
        ],
        CancelRecordEvent::class => [
            CreateRecordLogListner::class,
            UpdateRecordBalanceListner::class
        ]
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
