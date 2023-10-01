<?php

namespace App\Listeners;

use App\Events\SeriesCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSeriesCreatedListener implements ShouldQueue
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
     * @param  App\Events\SeriesCreatedEvent  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        //
    }
}
