<?php

namespace App\Providers;

use App\Events\SeriesCreatedEvent;
use App\Events\SeriesDeletedEvent;
use Illuminate\Auth\Events\Registered;
use App\Listeners\LogSeriesCreatedListener;
use App\Listeners\LogSeriesDeletedListener;
use App\Listeners\EmailUsersAboutSeriesCreateListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class =>
        [
            SendEmailVerificationNotification::class,
        ],
        SeriesCreatedEvent::class =>
        [
            EmailUsersAboutSeriesCreateListener::class,
            LogSeriesCreatedListener::class,
        ],
        SeriesDeletedEvent::class =>
        [
            LogSeriesDeletedListener::class,
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
