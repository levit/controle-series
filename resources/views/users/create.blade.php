<x-layout title="Novo usuário">

    <form action="{{route('users.create')}}" method="post">
    	@csrf

		<div class="row mb-3">    
        	<div class="col-5">
        		<label for="name" class="form-label">Nome:</label>
        		<input type="text" 
        			   autofocus
        			   id="name" 
        			   name="name" 
        			   class="form-control">
        	</div>
        	<div class="col-4">
        		<label for="email" class="form-label">E-mail:</label>
        		<input type="email" 
        			   id="email" 
        			   name="email" 
        			   class="form-control">
        	</div>  		
        	<div class="col-3">
        		<label for="episodesPerSeason" class="form-label">Senha:</label>
        		<input type="password" 
        			   id="password" 
        			   name="password" 
        			   class="form-control">
        	</div>  		
        	  		
    	</div>
    	<button type="submit" class="btn btn-primary">Salvar</button>
    </form>
	
</x-layout>