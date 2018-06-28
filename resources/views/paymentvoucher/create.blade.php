@extends('layouts.master')

@section('content')
<script type="text/javascript">
$(document).ready(function(){
	$('.cheque').hide();
	$('#invoice_ref_id').change(function(){
		window.location = '?id='+$(this).val();
	});
	$('#type').change(function(){
		if($(this).val()==1)$('.cheque').show();
		else $('.cheque').hide();
	});
})

</script>
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <h1>Create New Payment Voucher <a href="{{ url('/paymentvoucher') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <hr/>

    {!! Form::open(['url' => 'paymentvoucher', 'class' => 'form-horizontal']) !!}
    
    <div class="form-group">
                        {!! Form::label('invoice_ref', 'Invoice Ref: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('invoice_ref', $invoice_ref, isset($_GET['id'])?$_GET['id']:null, ['class' => 'form-control', 'id'=>'invoice_ref_id']) !!}
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('balance', 'Balance: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                           <input class="form-control" name="balance" type="text" value="{{ $balance['payable']  - ($balance['itemReturnPrice'] + $balance['paidPrice']) }}" disabled="disabled">
                        </div>    
                    </div>
                    
                    
                    <div class="form-group">
                        {!! Form::label('payment', 'Payment: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('payment', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('type', 'Type: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('type', $type, null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    
                    <div class="form-group cheque">
                        {!! Form::label('bank_name', 'Bank Name: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group cheque">
                        {!! Form::label('cheque_no', 'Cheque Number: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('cheque_no', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('payment_date', 'Payment Date: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('payment_date', date('Y-m-d'), ['class' => 'form-control']) !!}
                        </div>    
                    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    {!! Form::close() !!}
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-success">Paid To supplier = {{ $balance['paidPrice'] }}</a>
  <a href="#" class="list-group-item list-group-item-info">Total Payable = {{ $balance['payable'] }}</a>
  <a href="#" class="list-group-item list-group-item-warning">Purchase Return = {{ $balance['itemReturnPrice'] }}</a>
  <a href="#" class="list-group-item list-group-item-danger">Balance = {{ $balance['payable']  - ($balance['itemReturnPrice'] + $balance['paidPrice']) }}</a>
</div>


@endsection
