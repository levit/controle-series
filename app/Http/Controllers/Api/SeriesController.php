<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\Interfaces\SeriesRepository;

class SeriesController extends Controller
{

    private SeriesRepository $repository;

    public function __construct(SeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $query = Series::query();

        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }

        return $query->paginate(5);
    }

    public function show(int $id, Request $request)
    {
        $series = Series::with('seasons.episodes')
            ->where('id', $id)
            ->first();

        if ($series == null) {
            return response()->noContent(404);
        }

        return response()->json($series, 200);
    }

    public function update(int $id, Request $request)
    {
        $series = Series::where('id', $id)
            ->with('seasons.episodes')
            ->first();

        if ($series == null) {
            return response()->noContent(404);
        }

        $series->fill($request->all());
        $series->save();
        return response()->json($series, 200);
    }

    public function destroy(int $id, Request $request)
    {
        $series = Series::where('id', $id)
            ->with('seasons.episodes')
            ->first();

        if ($series == null) {
            return response()->noContent(404);
        }

        $series->delete();
        return response()->noContent(204);
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->repository->add($request);

        return response()->json($series, 201);
    }



}
