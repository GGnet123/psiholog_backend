<?php

namespace App\Events;

use App\Models\Main\Subscription;
use App\Models\Record\RecordDoctor;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateSubscriptionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Subscription $subscription;
    public User $user;

    public function __construct(Subscription $subscription, User $user)
    {
        $this->subscription = $subscription;
        $this->user = $user;
    }
}
