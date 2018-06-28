@extends('layouts.master')

@section('content')

    <h1>Edit Purchase: {{ $purchase->item->item_name }} ({{( $purchase->item->item_number)}})</h1>
    <hr/>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::model($purchase, ['method' => 'PATCH', 'action' => ['PurchaseController@update', $purchase->id], 'class' => 'form-horizontal']) !!}

    <div class="form-group" style="display:none">
                        {!! Form::label('item_id', 'Item Id: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('supplier_id', 'Supplier Id: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('supplier_id', $suppliers,null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('unit_price', 'Unit Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_price', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('unit_tax', 'Unit Tax: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_tax', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('tax_type', 'Tax Type: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::select('tax_type',['0'=>'%', '1'=>'price'], null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('unit_price_with_tax', 'Unit Price With Tax: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_price_with_tax', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('unit_count', 'Quantity: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('unit_count', null, ['class' => 'form-control']) !!}
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('carriage_charges', 'Carriage Charges: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('carriage_charges', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div>
                    <div class="form-group">
                        {!! Form::label('load_charges', 'Loading/Unloading Charges: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('load_charges', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
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
                            {!! Form::text('payable', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('paid_price', 'Paid Price: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('paid_price', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('invoice_ref', 'Invoice Ref: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('invoice_ref', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div><div class="form-group">
                        {!! Form::label('purchase_date', 'Purchase Date: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6"> 
                            {!! Form::text('purchase_date', null, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        </div>    
                    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}



@endsection
