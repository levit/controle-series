<?php

namespace App\Listeners;

use App\Events\SeriesCreateEvent;
use App\Models\User;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * EmailUsersAboutSeriesCreateListener
 */
class EmailUsersAboutSeriesCreateListener implements ShouldQueue
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
     * @param  App\Events\SeriesController  $event
     * @return void
     */
    public function handle(SeriesCreateEvent $event)
    {
        $userList = User::all();

        foreach ($userList as $index => $user) {

            $email = new SeriesCreated(
                $event->id,
                $event->nome,
                $event->seasonsQty,
                $event->episodesPerSeason
            );

            //Mail::to($user)->send($email); -> Envia imediatamente
            //Mail::to($user)->queue($email); -> Coloca na fila

            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);

        }
    }

}
