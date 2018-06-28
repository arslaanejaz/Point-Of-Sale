@extends('layouts.master')

@section('content')
<script type="text/javascript">
$(document).ready(function(){

	$('.returnProdict').click(function(e) {
	    if($(this).is(":checked")){
		 $(this).parent().parent().find('td').eq(0).addClass("strikeout");
		 $(this).parent().parent().find('td').eq(1).addClass("strikeout");
		 $(this).parent().parent().find('td').eq(2).addClass("strikeout");
	    }else{
	    	$(this).parent().parent().find('td').eq(0).removeClass("strikeout");
			 $(this).parent().parent().find('td').eq(1).removeClass("strikeout");
			 $(this).parent().parent().find('td').eq(2).removeClass("strikeout");
		    }
	});
});
</script>


    <h1>Sale Return <a href="{{ url('/salereturn/create') }}" class="btn btn-primary pull-right btn-sm">Add New Salereturn</a></h1>
    {!! Form::open(['url' => 'salereturn', 'class' => 'form-horizontal']) !!}
    <div class="col-lg-12">
    <div class="input-group">
    <div class="col-sm-6"> 
                            
                            <input type="hidden" value="" name="transaction_id" id="item_id" />
                        </div> 
      <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ isset($_POST['transaction_id'])?$_POST['transaction_id']:'' }}" placeholder="Slip Number">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Get Data!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  {!! Form::close() !!}
  <br /><br /><br />
    
    @if($inv)
    {!! Form::open(['url' => 'salereturn/savePrint', 'class' => 'form-horizontal']) !!}
    <input type="hidden" name="transaction_id" value="{{ $transaction_id }}" />
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Name</th><th>selling_price</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($inv as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->item->item_name }}</td>
                    <td>{{ $item->selling_price }}</td>
                    <td><input type="checkbox" name="ids[]" value="{{ $item->item_id.','.$item->id }}" class="returnProdict"></td>
                    </tr>
            @endforeach
             @foreach($return_item as $item)
                {{-- */$x++;/* --}}
                <tr class="strikeout">
                    <td>{{ $x }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td colspan="2">{{ $item->selling_price }}</td>
                    </tr>
            @endforeach
        </table>
    </div>
    
   <div class="form-group">
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
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
     {!! Form::close() !!}
    @endif
    @if($salereturns)
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Slip Number</th><th>Return Price</th>
            </tr>
            @foreach($salereturns as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('/salereturn', $item->id) }}">{{ $item->return_price }}</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif

@endsection
