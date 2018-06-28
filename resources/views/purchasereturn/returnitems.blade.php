@extends('layouts.master')

@section('content')
<script type="text/javascript">
$(document).on('keyup', '#return_item_count', function(){
	var in_stock = $('#in_stock').val();
	in_stock = parseInt(in_stock);
	var unit_purchase_price = $('#unit_purchase_price').val(); 
	unit_purchase_price = parseInt(unit_purchase_price);
	var return_item_count = $(this).val(); 
	return_item_count = parseInt(return_item_count);

	if(in_stock<return_item_count){
		alert('Value should be less than '+return_item_count);
		$(this).val(in_stock);
		$('#return_price').val(in_stock*unit_purchase_price);
		return;
		}else{
			$('#return_price').val(return_item_count*unit_purchase_price);
			}
	
})
</script>


<h1>Purchase Return Item</h1>
   @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
        {!! Form::open(['url' => 'purchasereturn', 'class' => 'form-horizontal']) !!}
<input type="hidden" name="purchase_id" value="{{ $purchase->id }}" />
<input type="hidden" name="item_id" value="{{ $purchase->item_id }}" />
<input type="hidden" name="invoice_ref" value="{{ $purchase->invoice_ref }}" />
<input type="hidden" name="in_stock" id="in_stock" value="{{ $in_stock }}" />
   <div class="form-group">
                        {!! Form::label('reason', 'Reason: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('reason', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('return_item_count', 'Number Of Items To Return: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('return_item_count', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('return_price', 'Return Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-2"> 
                            {!! Form::text('return_price', null, ['class' => 'form-control']) !!}
                        </div> 
                        {!! Form::label('unit_purchase_price', 'Unit Purchase Price: ', ['class' => 'col-sm-2 control-label']) !!} 
                        <div class="col-sm-2"> 
                            {!! Form::text('unit_purchase_price', $purchase->unit_purchase_price, ['class' => 'form-control', 'readonly'=>'readonly']) !!}
                        </div>   
                    </div>
                    
                    
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
     {!! Form::close() !!}


@endsection
