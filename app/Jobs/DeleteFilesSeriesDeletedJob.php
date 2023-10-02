<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Events\SeriesDeletedEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteFilesSeriesDeletedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private readonly string $path;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\SeriesDeletedEvent  $event
     * @return void
     */
    public function handle(SeriesDeletedEvent $event)
    {
        if (Storage::disk('public')->delete($this->path)) {
            Log::info("Arquivo '{$this->path}' deletada com sucesso.");
        } else {
            Log::error("Falha ao remover o arquivo '{$this->path}'");
        }
    }
}
