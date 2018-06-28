@extends('layouts.master')

@section('content')

<h1>Purchase Return</h1>
   
    {!! Form::open(['url' => 'purchasereturn', 'class' => 'form-horizontal', 'method'=>'get']) !!}
    <div class="col-lg-12">
    <div class="input-group">
    <div class="col-sm-6"> 
                        </div> 
      <input type="text" class="form-control" id="invoice_ref" name="invoice_ref" value="{{ isset($_GET['invoice_ref'])?$_GET['invoice_ref']:'' }}" placeholder="Voucher Reference Number">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Get Data!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  {!! Form::close() !!}
  <br /><br /><br />
    
    @if($inv)
    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Item Name</th><th>Purchase Date</th>
                <th>Invoice Reference</th><th>Supplier</th><th>Quantity Purchased</th>
                <th>Quantity Sold</th><th>Quantity Returned</th><th>Quantity In Stock</th><th>Action</th>
            </tr>
          
            {{-- */$x=0;/* --}}
            @foreach($inv as $item)
                {{-- */$x++;/* --}}
                 {{-- */$instock = $item->unit_count - ($item->sold_ct + $item->p_return_ct);/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->purchase_date }}</td>
                    <td>{{ $item->invoice_ref }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>{{ $item->unit_count }}</td>
                    <td>{{ $item->sold_ct }}</td>
                    <td>{{ $item->p_return_ct }}</td>
                    <td>{{ $instock }}</td>
                    <td><a href="{{ url('/purchasereturn/returnitems/'.$item->purchase_id.'/'.$instock) }}" class="btn btn-primary pull-right btn-sm">Edit</a></td>
                    </tr>
            @endforeach
        </table>
    </div>

    @endif

@endsection
