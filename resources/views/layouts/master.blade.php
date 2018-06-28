<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POS</title>
	<link rel="stylesheet" href="{{ url('/resources/assets/css/font-awesome.css') }}">

	<script src="{{ url('/resources/assets/js/jquery.js') }}"></script>
<!-- 	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- 	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet"> -->
	<link href="{{ url('/assets/css/flatly.min.css') }}" rel="stylesheet">
	<link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
 

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
                <li><a href="#">I want some Help</a></li>
                
                <li><a href="{{ url('/home') }}"><button class="btn btn-default" >Home</button></a></li>
        	</ul>
        </div>
    </div>
    </div>
</section>
 <section class="body-container">

	<div class="container">
		@yield('content')
	</div>
  </section>
	<hr/>

	<div class="container">
	    &copy; {{ date('Y') }}. PHP POS
	    <br/>
	</div>

	<!-- Scripts -->
<!-- 	<script src="{{ url('/resources/assets/js/jquery.min.js') }}"></script> -->
	<script src="{{ url('/resources/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('/resources/assets/js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript">

    function printData()
    {
       var divToPrint=document.getElementById("printTable");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }
    
        $(function() {
            $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }); //dd/mm/yy
            $('#print_report').on('click',function(){
            	printData();
            	})
        });
    </script>
</body>
</html>
