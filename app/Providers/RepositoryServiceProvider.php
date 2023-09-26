<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\SeriesRepository;
use App\Repositories\EloquentSeriesRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
    ];
    
}
 