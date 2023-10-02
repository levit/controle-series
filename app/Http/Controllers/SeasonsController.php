<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Serie;

class SeasonsController extends Controller
{
    public function index(Serie $series) {

        $seasons = Season::query()
            ->where('series_id', $series->id)
            ->with('episodes')
            ->get();

        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('series', $series);

    }

}
