@extends('layouts.master')

@section('content')

<script type="text/javascript">

function handleError(txt){
	var txt;
	var r = confirm("No data found. Want to add new item in the system");
	if (r == true) {
		
		window.open(
				"{{ url('/item/create/') }}?barcode="+txt,
				  '_blank'
				);
	} else {
	   // txt = "You pressed Cancel!";
		return false;
	}
	return false;
}

function totalPayable(){
	var unit_price = $('#unit_price').val(); 
	var unit_tax = $('#unit_tax').val();
	var tax_type = $('#tax_type').val();
	var unit_count = $('#unit_count').val(); 
	var carriage_charges = $('#carriage_charges').val();
	var load_charges = $('#load_charges').val();

	unit_price = parseInt(unit_price)?parseInt(unit_price):0; 
	unit_tax = parseInt(unit_tax)?parseInt(unit_tax):0; 
	tax_type = parseInt(tax_type)?parseInt(tax_type):0; 
	unit_count = parseInt(unit_count)?parseInt(unit_count):0;
	carriage_charges = parseInt(carriage_charges)?parseInt(carriage_charges):0; 
	load_charges = parseInt(load_charges)?parseInt(load_charges):0; 
	
	var with_tax_price = 0;
	
	if(tax_type==0){
		with_tax_price = (unit_price*unit_tax/100) + unit_price;
		}else{
			with_tax_price = unit_tax + unit_price;
			}
    var totalPayable = (with_tax_price*unit_count) + carriage_charges + load_charges;
    $('#unit_price_with_tax').val(with_tax_price);

	 
	$('#payable').val(totalPayable);
	if(unit_count>0){
	$('#unit_purchase_price').val(total_cal = with_tax_price + (carriage_charges + load_charges)/unit_count);
	}
}

//function taxCalculation(){
	
	//var unit_price = $('#unit_price').val(); 
	//var unit_tax = $('#unit_tax').val();
	//var tax_type = $('#tax_type').val();

	//unit_price = parseInt(unit_price); 
	//unit_tax = parseInt(unit_tax); 
	//tax_type = parseInt(tax_type); 
	
	//var with_tax_price = 0;
	//if(tax_type==0){
		//with_tax_price = (unit_price*unit_tax/100) + unit_price;
		//}else{
			//with_tax_price = unit_tax + unit_price;
			//}
	 
	//$('#unit_price_with_tax').val(with_tax_price);
	
//}


$(document).on('change', '#tax_type', function(){
	//taxCalculation();
	totalPayable();
});


$(document).on('keyup', '#unit_price, #unit_tax, #unit_count, #carriage_charges, #load_charges', function(){
	totalPayable();
});

$(document).ready(function(){


		//bcode 
	    var pressed = false; 
	    var chars = []; 
	    $(window).keypress(function(e) {
	        if (e.which >= 48 && e.which <= 57) {
	            chars.push(String.fromCharCode(e.which));
	        }
	        if (pressed == false) {
	            setTimeout(function(){
	                if (chars.length >= 5) {
	                    var barcode = chars.join("");
	                    $("#bocde").val(barcode);
	                    $('#gd').trigger( "click" );
	                    
	                }
	                chars = [];
	                pressed = false;
	            },100);
	        }
	        pressed = true;
	    });

	$(document).keypress(function(e){
	    if ( e.which === 13 ) {
	        //console.log("Prevent form submit.");
	        e.preventDefault();
	    }
	});
	//bcode 

	

	$('#gd').click(function(e) {
	    
	    $.ajax({
			url:"{{ url('/transaction/getbcode/') }}/"+$('#bocde').val(),
			type: 'GET',
			dataType: 'JSON',
			success:function(e){
				if(e.error)handleError(e.bocde);
				$('#item_name').val(e.data.item_name + " (Quantity In Stock: "+e.data.quantity_in_stock+",  Sold Items: "+e.solditems+")");
				$('#item_id').val(e.data.id);
				
			},
			error:function(error){
				alert('Something Went Wrong. Please try again.');
			}

			});
	});
});


</script>


    <h1>Create New Purchase</h1>
    <hr/>
     @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="col-lg-12">
    <div class="input-group">
      <input type="text" class="form-control" id="bocde" value="" placeholder="0000000000000">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="gd">Get Data!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
<br /><br /><br />
    {!! Form::open(['url' => 'purchase', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
                        {!! Form::label('item_id', 'Item: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text(null, null, ['class' => 'form-control', 'id'=>'item_name']) !!}
                            <input type="hidden" value="" name="item_id" id="item_id" />
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('supplier_id', 'Supplier: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('unit_price', 'Unit Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_price', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('tax_type', 'Tax Type: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('tax_type', ['0'=>'%', '1'=>'price'], null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('unit_tax', 'Unit Tax: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_tax', 0, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('unit_price_with_tax', 'Unit Price With Tax: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_price_with_tax', null, ['class' => 'form-control', 'readonly'=>'readonly']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('unit_count', 'Quantity (1 to 5000): ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-2"> 
                            {!! Form::text('unit_count', 0, ['class' => 'form-control']) !!}
                        </div>    
                        {!! Form::label('unit', 'Unit: ', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-2"> 
                            {!! Form::select('unit', ['NO.','Feet','Meter','KG'], null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    
                    
                    <div class="form-group">
                        {!! Form::label('carriage_charges', 'Carriage Charges: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('carriage_charges', 0, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('load_charges', 'Loading/Unloading Charges: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('load_charges', 0, ['class' => 'form-control']) !!}
                        </div>    
                    </div>

                    
                    
                    <div class="form-group">
                        {!! Form::label('selling_price', 'Unit Selling Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-2"> 
                            {!! Form::text('selling_price', null, ['class' => 'form-control']) !!}
                        </div> 
                        {!! Form::label('unit_purchase_price', 'Unit Purchase Price: ', ['class' => 'col-sm-2 control-label']) !!} 
                        <div class="col-sm-2"> 
                            {!! Form::text('unit_purchase_price', null, ['class' => 'form-control', 'readonly'=>'readonly']) !!}
                        </div>   
                    </div>
                    
                    
                    <div class="form-group">
                        {!! Form::label('payable', 'Payable: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('payable', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('paid_price', 'Paid Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('paid_price', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('invoice_ref', 'Invoice Reference Number: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('invoice_ref', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('purchase_date', 'Purchase Date: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('purchase_date', date('Y-m-d'), ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('remarks', 'Remarks (255 max): ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::textarea('remarks', null, ['class' => 'form-control', 'rows'=>5]) !!}
                        </div>    
                    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    {!! Form::close() !!}

   

@endsection
