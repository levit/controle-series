<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;

class SeasonsController extends Controller
{
    public function index(Series $series) {

        $seasons = Season::query()
            ->where('series_id', $series->id)
            ->with('episodes')
            ->get();

        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('series', $series);

    }

}
