@extends('layouts.master')

@section('content')

    <h1>Profit/Loss Report <a href="{{ url('/reports') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <hr/>
{!! Form::open(['url' => 'reports/profit_loss_report','method'=>'get', 'class' => 'form-inline']) !!}
    <div class="form-group">
        <label for="start_date">Start Invoice Date</label>
        <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="Start Date" value="{{ isset($_GET['start_date'])?$_GET['start_date']:'' }}">
    </div>
    <div class="form-group">
        <label for="endingdate">Ending Invoice Date</label>
        <input type="text" class="form-control datepicker" id="endingdate" name="end_date" placeholder="Ending Date" value="{{ isset($_GET['end_date'])?$_GET['end_date']:'' }}">
    </div>
    <button type="submit" class="btn btn-default">Enter</button>
    {!! Form::close() !!}
</hr>
</br></br></br>
<div class="table">
    <table class="table table-bordered table-striped table-hover" id="printTable">
        <tr>
            <th>SL.</th><th>Invoice No.</th>
            <th>Invoice Date</th>
            <th>Item Name</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Sold Quantity</th>
            <th>Sale Type</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>Net</th>
        </tr>
        @if($nodata)
        <tr>
            <td colspan="10" align="center">No Data Found</td>
        </tr>
        @else
        {{-- */$x=0;
        $sale_total = 0;
        $purchase_total = 0;
        $net_total = 0;
        /* --}}
        @foreach($transaction as $item)
        {{-- */
        	$x++;

            $purchase_price = $item->unit_purchase_price * $item->qty;
            $net = $item->selling_price_sum - $purchase_price;
            
            $sale_total += $item->selling_price_sum;
            $purchase_total += $purchase_price;
            $net_total += $net;
            
            /* --}}
         <tr>
            <td>{{ $x }}</td>
            <td>{{ $item->invoice_ref }}</td>
            <td>{{ date("d-m-Y", strtotime($item->purchase_date)) }}</td>
            <td>{{ $item->item_name }}</td>
            <td>{{ $item->brand_name }}</td>
            <td>{{ $item->category_name }}</td>
            <td>{{ $item->suppliers_name }}</td>
            <td>{{ $item->qty }}</td>
            
            <td>Cash</td>
            <td>{{ $purchase_price }}</td>

            <td>{{ $item->selling_price_sum }}</td>
            <td>{{ $net }}</td>
        </tr>
        
        @endforeach
        <tr>
            <td colspan="9" align="center"><b>Grand Total</b></td><td colspan="1"><b>{{ $purchase_total }}</b></td><td colspan="1"><b>{{ $sale_total }}</b></td><td colspan="1"><b>{{ $net_total }}</b></td>
           
        </tr>
        @endif
    </table>
</div>

<button id="print_report">Print Report</button>







@endsection
