<x-layout title="Séries">
    <img
        width="200px"
        src="{{asset('storage/'.$series->cover)}}"
        alt="Capa da Série"
        class="img-fluid mb-3"/>

	<ul class="list-group">
		@foreach ($seasons as $season)
		   <li class="list-group-item d-flex justify-content-between align-items-center">
		   	   <a href="{{route('episodes.index', $season->id)}}">
		   	     Temporada {{ $season->number }}
   		   	   </a>

    		   <span class="badge bg-secondary">
    		   	  {{ $season->episodes->filter(fn ($episode) => $episode->watched)->count() }} de {{ $season->episodes->count() }} eposódios
    		   </span>

		   </li>
		@endforeach
	</ul>
</x-layout>

