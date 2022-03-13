<?php

namespace App\Listeners;

use App\Events\CreateSubscriptionEvent;
use App\Models\Main\Balancer;
use App\Models\Main\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSubscriptionBalancerLister
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
     * @param  \App\Events\CreateSubscriptionEvent  $event
     * @return void
     */
    public function handle(CreateSubscriptionEvent $event)
    {

        $subscription = $event->subscription;
        $user = $event->user;

        $balance = Balancer::create([
            'is_done' => true,
            'is_canceled' => false,
            'user_id' => $user->id,
            'sum' => $subscription->by_month ? Subscription::COST_MONTH : Subscription::COST_YEAR,
            'subscription_id' => $subscription->id,
            'need_returned' => false,
            'is_returned' => false
        ]);
    }
}
