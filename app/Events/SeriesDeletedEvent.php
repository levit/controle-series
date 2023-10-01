<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriesDeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public readonly int $id;
    public readonly string $nome;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $id, string $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
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
