<!doctype html>

<html lang="pt-BR">

    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="Content-Type" content="text/html">
    	<title>{{$title}}</title>
    	<link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    
    <body>
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('series.index')}}">Home</a>
            
            @auth
            <a class="nav-link" href="{{route('login.logout')}}">Sair</a>
            @endauth
            
            @guest
            <a class="nav-link" href="{{route('login')}}">Entrar</a>
            @endguest
          </div>
        </nav>    
        
    	<div class="container">
    		<h1>{{$title}}</h1>
			<x-mensagem/>    		
			<x-validade/>
    		{{$slot}}
    	</div>
    </body>

</html>

