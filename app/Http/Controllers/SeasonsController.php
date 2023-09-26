<?php

namespace App\Http\Controllers;

use App\Models\Season;

class SeasonsController extends Controller
{
    public function index(int $series) {
        
        $seasons = Season::query()
            ->where('series_id', $series)
            ->with('episodes')
            ->get();
        
        return view('seasons.index')
            ->with('seasons', $seasons);
        
    }
    
}
