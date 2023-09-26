<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;


interface SeriesRepository
{

    public function add(SeriesFormRequest $request): Serie;
    
}
