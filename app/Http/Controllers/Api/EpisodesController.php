<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SeriesRepository;

class EpisodesController extends Controller
{

    private SeriesRepository $repository;

    public function __construct(SeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Series $series, Request $request)
    {
        return $series->episodes;
    }

}
