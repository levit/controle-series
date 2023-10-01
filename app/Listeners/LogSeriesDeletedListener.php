<?php

namespace App\Listeners;

use App\Events\SeriesDeletedEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSeriesDeletedListener implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  App\Events\SeriesDeletedEvent  $event
     * @return void
     */
    public function handle(SeriesDeletedEvent $event)
    {
        Log::info("Serie '{$event->nome}' com id '{$event->id}' deletada com sucesso.");
    }
}
