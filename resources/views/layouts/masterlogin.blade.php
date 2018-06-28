<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Point Of Sale</title>
 
	<script src="{{ url('/assets/js/jquery.js') }}"></script>
<!-- 	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- 	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet"> -->
	<link href="{{ url('/assets/css/flatly.min.css') }}" rel="stylesheet">
	<link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet">
	
</head>
<body>
<section class="header">
	<div class="container-fluid">
    <div class="row">
    	<div class="logo col-lg-3">
        	<img class="img-responsive" src="{{ url('/assets/image/logo.png') }}" alt="" />
        </div>
        
        <div class="alert pull-right">
        	<ul>
                {{--<li><a href="#">I want some Help</a></li>--}}
                
                {{--<li><a href="{{ url('/auth/register') }}"><button class="btn btn-default" >Create new Account</button></a></li>--}}
        	</ul>
        </div>
    </div>
    </div>
</section>
 <section class="body-container">

 		@yield('content')
   </section>
	<hr/>

<section class="modal-footer">
	<div class="container-fluid">
    	<div class="menu">
        	<ul>
            	<li><a href="#">Contact</a></li>
            	<li><a href="#">Help</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">How POS works</a></li>
                <li><a href="#">License Notices</a></li>
                <li><a href="#">Legal Matters</a></li>
            </ul>
            
            <p>Copyright (C) 2015</p>
            	<hr class="border">
            <p>Powerer by Viraastech.com</p>
        </div>
    </div>
</section>

	<!-- Scripts -->
<!-- 	<script src="{{ url('/assets/js/jquery.min.js') }}"></script> -->
	<script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>
 	<script type="text/javascript">

</script>
    
</body>
</html>
