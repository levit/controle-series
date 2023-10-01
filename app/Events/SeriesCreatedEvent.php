<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriesCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public readonly int $id;
    public readonly string $nome;
    public readonly int $seasonsQty;
    public readonly int $episodesPerSeason;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $id, string $nome, int $seasonsQty, int $episodesPerSeason)
    {

        $this->id = $id;
        $this->nome = $nome;
        $this->seasonsQty = $seasonsQty;
        $this->episodesPerSeason = $episodesPerSeason;

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
