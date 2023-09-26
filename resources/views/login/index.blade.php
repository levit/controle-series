<x-layout title="Login">

    <form method="post" action="{{route('login.sign')}}">
    	@csrf

		<div class="form-group mb-3">    
    		<label for="email" class="form-label">E-mail:</label>
    		<input type="email" 
    			   autofocus
    			   id="email" 
    			   name="email" 
    			   class="form-control">
        	  		
    	</div>
    	
		<div class="form-group">    
    		<label for="password" class="form-label">Senha:</label>
    		<input type="password" 
    			   id="password" 
    			   name="password" 
    			   class="form-control">
        	  		
    	</div>
    	
    	<button class="btn btn-primary mt-3">Entrar</button>
    	
    	<a href="{{route('users.create')}}" class="btn btn-secondary mt-3">Registrar</a>
    	
    </form>
	
</x-layout>