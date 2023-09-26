<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Serie;
use App\Mail\SeriesCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Autenticador;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\Interfaces\SeriesRepository;

class SeriesController extends Controller
{

    private SeriesRepository $repository;

    public function __construct(SeriesRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(Autenticador::class)->except('series.index');
    }

    public function index(Request $request)
    {
//         if (!Auth::check()) {
//             throw new AuthenticationException();
//         }

        //$series = Serie::all('nome');
        //DB::select('select nome from series;');
        //$series = Serie::query()->orderBy('nome')->get(); = Transferido para a Classe padrÃÂ£o Serie

        //$series = Serie::active()->get();  = Traz somente registro configurado no scopo (dentro da Classe Serie)
        //$series = Serie::with(['seasons'])->get();

        $series = Serie::all();
         $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        //$request->session()->forget('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);

    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {

        //dd($request->all());

        $serie = $this->repository->add($request);

        $userList = User::all();

        foreach ($userList as $user) {

            $email = new SeriesCreated(
                $serie->id,
                $serie->nome,
                $request->seasonsQty,
                $request->episodesPerSeason
            );

            Mail::to($user)->queue($email);

        }

        return redirect()->route('series.index')
            -> with('mensagem.sucesso', "Série '{$serie->nome}' incluída com sucesso");

        /*
        if (DB::insert('INSERT INTO series (nome) values (?)', [$nomeSerie])) {
            return redirect('/series');
        } else {
            return 'ERRO';
        }
        */

    }

    public function destroy(Serie $series, Request $request)
    {
        //$serie = Serie::find($request->id);
        //Serie::destroy($request->id);

        $series->delete();

        //$request->session()->put('mensagem.sucesso', 'Série excluído com sucesso');
        //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' excluído com sucesso");

        //return redirect()->route('series.index');
        return redirect()->route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' excluído com sucesso");
    }

    public function edit(Serie $series)
    {

        //dd($series->seasons());

        return view('series.edit')
        ->with('series', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {

        $series->fill($request->all());
        $series->save();

        return redirect()->route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizado com sucesso");

    }

}
