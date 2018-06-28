@extends('layouts.master')

@section('content')
<style>
.removeRow{cursor: pointer; width: 17px;}
</style>
<script type="text/javascript">

$(document).on("keyup", "#pay", function(e) {
	totalCount()
});
$(document).on("keyup", "#discount", function(e) {
	totalCount()
});


function totalCount(){
	var g_total = $('#g_total').text();
	var discount = $('#discount').val()==''?0:$('#discount').val();
	var pay = $('#pay').val()==''?0:$('#pay').val();
	$('#customer_change').val(parseInt(pay) - (parseInt(g_total) - parseInt(discount)));
}

$(document).on("keypress", ".qtyText", function(e) {
    if (e.which == 43) { //e.which == 13
    	e.preventDefault();
        var keyTr = $(this).parent().parent();
        var keyItemId = keyTr.attr('rowID');
        var keyNewQty = this.value;
        var keyOldQty = keyTr.find('td').eq(6).text();
       $.ajax({
   		url:"{{ url('/transaction/changeQuantity/') }}",
   		type: 'POST',
   		data: {item_id:keyItemId, new_qty:keyNewQty, old_qty:keyOldQty},
   		dataType: 'JSON',
   		success:function(data){
   			if(data.code==0){alert('Not a valid data!'); return;}
   			else if(data.code==1){alert('Item limit exeeded!'); return;}
   	   		addTableRow(i, null, data.new_qty, data.amount, data.item_id);
   			calculateGTotal();
   		},
   		error:function(error){
   			alert('Something Went Wrong. Please try again.');
   		}
   		});
        return false;
    }
});

function handleError(txt){
	var txt;
	var r = confirm("No data found. Want to add new item in the system");
	if (r == true) {
		
		window.open(
				"{{ url('/item/create/') }}?barcode="+txt,
				  '_blank'
				);
	} else {
		return false;
	}
	return false;
}

function addTableRow(i, item_name, quantity, amount, item_id){
	thisTr = $("tr[rowID='" + item_id + "']");
	var oldAmount = 0;
	var newAmount = 0;
	var newQty = 0;
	var newPrice = 0;
	
	if(thisTr.length){
		if(item_name==null)newQty = quantity;
		else thisTr.find('td').eq(3).find("input").each(function(){newQty = parseInt(this.value)+1; this.value = newQty;});
		oldAmount = thisTr.find('td').eq(4).text();
		newAmount = parseInt(oldAmount)+parseInt(amount);
		thisTr.find('td').eq(4).text(parseFloat(newAmount).toFixed(2));
		thisTr.find('td').eq(2).html('<input type="text" style="display:none" name="hiddenprice[]" value="'+parseFloat(newAmount/newQty).toFixed(2)+'" >'+parseFloat(newAmount/newQty).toFixed(2));
		thisTr.find('td').eq(6).text(newQty);
		return;
		}
	newPrice = parseFloat(amount/quantity).toFixed(2);
	newAmount = parseFloat(amount).toFixed(2);
	$('#t_table tr:last').before('<tr rowID="'+item_id+'" class="myItem"><td>'
	+i+
	'</td><td><input type="text" style="display:none" name="hidden_item_name[]" value="'+item_name+'" >'+item_name+
	'</td><td><input type="text" style="display:none" name="hiddenprice[]" value="'+newPrice+'" >'+newPrice+
	'</td><td><input type="text" style="display:none" name="hiddenQty[]" value="'+quantity+'" ><input type="text" class="qtyText" style="width:60px" value="'+quantity+'" /></td><td>'+newAmount+
	'</td><td><img class="removeRow" delete-id="'+item_id+
	'" src="{{ url("/resources/assets/image/delete.png") }}" /></td><td>'+quantity+'</td></tr>');
	
}


var product_price = 0;
var grand_total = 0;
var item_id = 0;
var i = 0;

function calculateGTotal(){
	grand_total = 0;
	$(".myItem").each(function(){
		tr_price = $(this).find('td').eq(2).text();
		$(this).find('td').eq(3).find("input").each(function(){tr_qty= this.value}); 
	      
	       grand_total = grand_total + (tr_price*tr_qty); 
	});
	$("#g_total").html(parseFloat(grand_total).toFixed(2));
	}

$(document).on('click', '.removeRow', function(){
	var item = $(this);
	var id = item.attr('delete-id');
	$.ajax({
		url:"{{ url('/transaction/deleteitem/') }}/"+id,
		type: 'DELETE',
		dataType: 'JSON',
		success:function(e){
			$("#t_table").find("[delete-id='" + e.id + "']").parent().parent().remove();
			calculateGTotal();
		},
		error:function(error){
			alert('Something Went Wrong. Please try again.');
		}
		});
});

	
	$(document).ready(function(){

		@if($old)
			var i=0;
			@foreach($pending as $item_id=>$val)
			i++;
			addTableRow(i, '{{ $val["name"] }}', '{{ $val["qty"] }}','{{ $val["amount"] }}', '{{ $item_id }}');
			@endforeach
			calculateGTotal();
			@endif
	
		
	$('#sd').attr('disabled', true);
			
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#token').val()
        }
    });


		$("#qty").bind('keyup input', function(){
			if($(this).val()<=0){$(this).val(1);return;}
			$('#item_total').html($(this).val()*product_price);
			
		});
	
	$('#gd').click(function(e) {
	    
	    $.ajax({
			url:"{{ url('/transaction/getItemPrice/') }}/"+$('#bocde').val(),
			type: 'GET',
			dataType: 'JSON',
			success:function(e){
				if(e.error){
					handleError(e.bocde)
					}else{
						data = e.data;
						i++;
addTableRow(i, data.item_name, 1, data.selling_price, data.item_id);
calculateGTotal()
						}
				//data = e.data;
				//product_price = data.selling_price;
				//item_id = data.id;
				//$('#item_name').val(data.item_name);
				//$('#amount').html(data.selling_price);
				//$('#item_total').html(data.selling_price);
				//$('#qty').val(1);
				//$('#qty').attr('disabled', false);
				//$('#sd').attr('disabled', false);
			},
			error:function(error){
				alert('Something Went Wrong. Please try again.');
			}

			});
	});
	

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


//bcode 


	
});
	$(document).keypress(function(e){
	    if ( e.which === 13 ) {
	        //console.log("Prevent form submit.");
	        e.preventDefault();
	    }
	});
</script>
<h4><a href="{{ url('transaction/trasnactionlist') }}">Transaction List</a> </h4>
<div class="col-lg-12">
    <div class="input-group">
      <input type="text" class="form-control" id="bocde" value="" placeholder="0000000000000">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="gd">Get Data!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <br />
  <br />
 {!! Form::open(['url' => 'transaction/store', 'class' => 'form-horizontal']) !!}
<br />

<div>
<table class="table table-striped" id="t_table">
<tr><th>#</th><th>Item Name</th><th>price</th><th>Quantity</th><th>Amount</th><th>Remove</th><th>Item Count</th></tr>
<tr><th colspan="4">Total</th><th colspan="2" id="g_total">0.00</th><th></th></tr>
</table>
<div class="input-group">
      <div class="input-group-addon">Discount</div>
       <input type="text" class="form-control" name="discount" id="discount" value="" placeholder="0">
      <div class="input-group-addon">.00</div>
    </div>
    <br />
    <div class="input-group">
      <div class="input-group-addon">Paid by customer</div>
       <input type="text" class="form-control" name="pay" id="pay" placeholder="0">
      <div class="input-group-addon">.00</div>
    </div>
    <br />
    <div class="input-group">
      <div class="input-group-addon">Customer Change</div>
      <input type="text" class="form-control" id="customer_change" disabled="disabled" placeholder="0">
      <div class="input-group-addon">.00</div>
    </div>
    <br />
<button type="submit" value="process" name="finish" class="btn btn-default">Finish</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" value="delete" name="finish" class="btn">Cancel</button>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<br />
<br />
{!! Form::select('customer', $customers, null, ['class' => 'form-control', 'id'=>'customer']) !!}
{!! Form::close() !!}
</div>
<br />
<?php 
if ($recipt) {
	?>
	
	<div class="right" id="section-to-print">
 <table>
  <tbody>
 <tr><td><img src="<?php echo url('/resources/assets/image/510.png')?>" style="width:1in;margin:0 auto"/></td></tr>
 <tr><td style="font-size: 12px;"> Chaudhary Traders</td></tr>
 <tr><td style="font-size: 12px;"> 143-B, Sector C, Commercial Area,</td></tr>
 <tr><td style="font-size: 12px;"> Bahria Town</td></tr>
 <tr><td style="font-size: 12px;"> Lahore</td></tr>
 <tr><td style="font-size: 12px;"> 042-37862661</td></tr>
 </tbody>
 </table>
<table style="border:1px solid #000;width:25%">
<tr><td><?php echo date('Y-m-d');?></td> <td><?php echo date('h:i:a');?></td> <td>ID: <?php echo $r_id?> </td></tr>
</table>
 
<table style="font-size: 12px;border:1px solid #000">
<tr><td>Itme Name</td><td>Qty</td> <td>Price</td></tr>
<tr style="height: 10px"></tr>
<?php
 $i = 0;
$itm_nbr =0;
$totl_price = 0;
foreach($recipt['hidden_item_name'] as $row)
{    $itm_nbr +=$recipt['hiddenQty'][$i];
    $totl_price +=$recipt['hiddenQty'][$i]*$recipt['hiddenprice'][$i];
	echo '<tr><td>';
	echo $row;
	echo '</td><td>'. $recipt['hiddenQty'][$i].'</td><td align="right"">'. $recipt['hiddenQty'][$i]*$recipt['hiddenprice'][$i].'</td></tr>';
     $i++;
	}
 ?>
</table> 
 
 <table style="border 1px solid" >
 <tr><td>Total Items: <?php echo $itm_nbr;?></td> </tr>
 </table>
 <table style="border 1px solid" >
 <tr> <td> Total Price: <?php echo $totl_price;?></td></tr>
 <tr><td>Discount :</td><td align="right"><?php echo $recipt['discount'];?></td></tr>
  <tr><td>Pay :</td><td align="right"><?php echo $recipt['pay'];?></td></tr>
  <tr><td>Change :</td><td align="right"><?php echo $recipt['pay']-($totl_price-$recipt['discount']);?></td></tr>

 </table>
 
 </div>
 <script>$(document).ready(function(){
	 window.print();
	 })</script>
<?php }?>

@endsection