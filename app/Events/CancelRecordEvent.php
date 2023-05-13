<?php

namespace App\Events;

use App\Models\Record\RecordDoctor;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CancelRecordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public RecordDoctor $record;
    public User $user;

    public function __construct(RecordDoctor $record, User $user)
    {
        $this->record = $record;
        $this->user = $user;
    }
}
