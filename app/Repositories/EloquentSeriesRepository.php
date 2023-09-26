<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Repositories\Interfaces\SeriesRepository;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{

    public function add(SeriesFormRequest $request): Serie 
    {

        DB::beginTransaction();
        
        try {
            $serie = Serie::create($request->all());
            
            /* Modelo 1 de gravação
             for ($i = 1; $i <= $request->seasonsQty; $i++) {
             $seasons = $serie->seasons()->create([
             'number' => $i
             ]);
             
             for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
             $seasons->episodes()->create([
             'number' => $j
             ]);
             }
             }
             */
            
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }
            Season::insert($seasons);
            
            
            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);
            
        } catch (\Throwable $e) {
            
            DB::rollBack();
            throw $e;
            
        } finally {
            
            DB::commit();
            return $serie;
            
        }
        
        /*
         $serie = new Serie($request->all());
         $serie->save();
         */
        
        /*
         $serie->nome = $nomeSerie;
         $serie->save();
         */
        
        
        /*
         $nomeSerie = $request->input('nome');
         $serie = new Serie();
         $serie->nome = $nomeSerie;
         $serie->save();
         */
        
        /* return redirect('/series'); */
        
        //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' incluída com sucesso");
        
        
    }
    
}
