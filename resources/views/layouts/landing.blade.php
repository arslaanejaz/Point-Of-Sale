<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POS</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
	<script src="{{ url('/assets/js/jquery.js') }}"></script>
<!-- 	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- 	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="{{ url('/assets/css/menu.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/assets/css/wapoint.css') }}">
	<link href="{{ url('/assets/css/flatly.min.css') }}" rel="stylesheet">
	<link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/css/jquery-ui.css') }}" rel="stylesheet">

</head>
<body>
<section class="header">
	<div class="container-fluid">
    <div class="row">
    	<div class="logo">
          <img class="img-responsive" src="{{ url('/assets/image/logo.png') }}" alt="" />
        </div>
        <div class="c-buttons pull-left">
        <button id="c-button--slide-left" class="c-button">
        	<span class="first-line"></span>
            <span class="second-line"></span>
            <span class="third-line"></span>
        </button>
</div>
        <div class="alert col-lg-4 col-sm-4 col-md-4 col-xs-4 pull-right">
        	<ul>
               <li><a href="#">I want some Help</a></li>
                
                <li><a href="{{ url('/auth/logout') }}"><button class="btn btn-default" >Logout</button></a></li>

        	</ul>
        </div>
    </div>
    </div>
</section>
 
 		@yield('content')
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

<div id="c-mask" class="c-mask"></div><!-- /c-mask -->

	<!-- Scripts -->
<!-- 	<script src="{{ url('/assets/js/jquery.min.js') }}"></script> -->
	<script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('/assets/js/jquery-ui.js') }}"></script>
	<script src="{{ url('/assets/js/waypoints.min.js') }}"></script>
	<script src="{{ url('/assets/js/menu.js') }}"></script>
	<script src="{{ url('/assets/js/custome.js') }}"></script>
 	
	<script type="text/javascript">

</script>
    <script>
        $(function() {
            $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
        $(function() {
            $( "#endingdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
</body>
</html>
