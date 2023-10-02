<?php

namespace App\Listeners;

use App\Events\SeriesDeletedEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class DeleteFilesSeriesDeletedListener implements ShouldQueue
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
        if (Storage::delete($event->cover)) {
            Log::info("Arquivo '{$event->cover}' deletada com sucesso.");
        } else {
            Log::error("Falha ao remover o arquivo '{$event->cover}'");
        }
    }
}
