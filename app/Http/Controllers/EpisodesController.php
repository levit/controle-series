<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{

    public function index(int $season) {
        
        $episodes = Episode::query()
        ->where('season_id', $season)
        ->get();
        
        return view('episodes.index', [
            'episodes' => $episodes,
            'mensagemSucesso' =>  session('mensagem.sucesso')
        ]);
        
    }
    
    public function update(Request $request, Season $season) {

        $watchesMark = $request->episodes;
        
        $season->episodes->each(function (Episode $episode) use ($watchesMark) {
            $episode->watched = in_array($episode->id, $watchesMark); 
        });
        
        $season->push(); // Salva em grupo
        
        //return to_route('episodes.index'); //, $season->id);
        return view('episodes.index')
            ->with('episodes', $season->episodes)
            ->with('mensagem.sucesso', "Episódios salvos com sucesso");
    
    }
}
