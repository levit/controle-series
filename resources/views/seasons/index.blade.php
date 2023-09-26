<x-layout title="Séries">
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

