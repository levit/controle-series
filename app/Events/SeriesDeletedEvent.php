<?php

namespace App\Events;

use App\Models\Serie;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SeriesDeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public readonly int $id;
    public readonly string $nome;
    public readonly string $cover;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $id, string $nome, string $cover)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cover = $cover;
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

