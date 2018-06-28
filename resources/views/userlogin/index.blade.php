@extends('layouts.masterlogin')

@section('content')

    	<div class="login-form col-lg-3">
        
        	    {!! Form::open(['method'=>'POST', 'url' => 'login']) !!}

           <div class="form-head"> 
        	<h2>Welcome to the Point of Sale</h2>
           </div> 
		   
		   
             <div class="form-inner">
                    <div class="form-group">
                        {!! Form::label('name', 'User Name: ')!!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('password', 'Password: ') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>
                           {!! Form::submit('Login', ['class' => 'btn-default pull-right']) !!}

             
            	<a href="#">Forgot your password?</a>
				
				  {!! Form::token() !!}
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
				
				
     </div>
 

	
	
	
	  
 
  

@endsection
