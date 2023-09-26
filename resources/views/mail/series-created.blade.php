@component('mail::message')

# {{$nomeSerie}} criada.


A Série {{$nomeSerie}} com {{$qtdTemporadas}} temporadas e {{$episodiosPorTemporada}} episódios.

Acesse aqui:
@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver Série
@endcomponent


Obrigado,<br>
Equipe Sistólica.
@endcomponent
