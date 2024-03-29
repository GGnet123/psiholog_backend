<?php

namespace App\Events;

use App\Models\Record\RecordDoctor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayedRecordNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public RecordDoctor $record;

    public function __construct(RecordDoctor $record)
    {
        $this->record = $record;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
