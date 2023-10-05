<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Events\SeriesCreatedEvent;
use App\Events\SeriesDeletedEvent;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteFilesSeriesDeletedJob;
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

        $series = Series::all();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

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

        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;

        $request['coverPath'] = $coverPath;

        $series = $this->repository->add($request);

        SeriesCreatedEvent::dispatch(
            $series->id,
            $series->nome,
            $request->seasonsQty,
            $request->episodesPerSeason
        );

        return redirect()->route('series.index')
            -> with('mensagem.sucesso', "Série '{$series->nome}' incluía com sucesso");

    }

    public function destroy(Series $series, Request $request)
    {

        SeriesDeletedEvent::dispatch(
            $series->id,
            $series->nome,
            $series->cover,
        );

        DeleteFilesSeriesDeletedJob::dispatch(
            $series->cover
        );

        $series->delete();

        return redirect()->route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' excluído com sucesso");

    }

    public function edit(Series $series)
    {

        return view('series.edit')
            ->with('series', $series);

    }

    public function update(Series $series, SeriesFormRequest $request)
    {

        $series->fill($request->all());
        $series->save();

        return redirect()->route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizado com sucesso");

    }

}
