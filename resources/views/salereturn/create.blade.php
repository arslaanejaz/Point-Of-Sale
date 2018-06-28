@extends('layouts.master')

@section('content')

<script type="text/javascript">

function handleError(txt){
	var txt;
	var r = alert("No data found in system");
	return false;
}


$(document).ready(function(){

	$('#gd').click(function(e) {
	    
	    $.ajax({
			url:"{{ url('/transaction/getbcode/') }}/"+$('#bocde').val(),
			type: 'GET',
			dataType: 'JSON',
			success:function(e){
				if(e.error)handleError(e.bocde);
				$('#item_name').val(e.data.item_name);
				$('#item_id').val(e.data.id);
				
			},
			error:function(error){
				alert('Something Went Wrong. Please try again.');
			}

			});
	});
});


</script>


    <h1>Create New Salereturn</h1>
    <hr/>
<div class="col-lg-12">
    <div class="input-group">
      <input type="text" class="form-control" id="bocde" value="-0000123456789" placeholder="-0000000000000">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="gd">Get Data!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <br />
  <br /><br />
    {!! Form::open(['url' => 'salereturn', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
                        {!! Form::label('item_id', 'Item Id: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text(null, null, ['class' => 'form-control', 'id'=>'item_name']) !!}
                            <input type="hidden" value="" name="item_id" id="item_id" />
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('reason', 'Reason: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('reason', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('customer_id', 'Customer: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('customer_id', $customers, null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('return_price', 'Return Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('return_price', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection
