<?php

namespace App\Repositories\Interfaces;

use App\Models\Episode;
use Illuminate\Foundation\Http\FormRequest;


interface EpisodeRepository
{

    public function add(FormRequest $request): Episode;
    
}
