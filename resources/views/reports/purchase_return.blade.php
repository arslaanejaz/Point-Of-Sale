@extends('layouts.master')

@section('content')

    <h1>Purchase return Report <a href="{{ url('/reports') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <hr/>
{!! Form::open(['url' => 'reports/purchase_return_report','method'=>'get', 'class' => 'form-inline']) !!}
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
    <table class="table table-bordered table-striped table-hover"  id="printTable">
        <tr>
            <th>SL.</th><th>Invoice No.</th>
            <th>Invoice Date</th><th>Item Name</th>
            <th>Brand</th><th>Category</th>
            <th>Supplier</th>
            <th>Sale Type</th><th>Purchase Price</th>
            <th>Purchase Return</th><th>Net Purchase Price</th>
            <th>Sold Quantity</th>
            <th>Sale Price</th>
        </tr>
        @if($nodata)
        <tr>
            <td colspan="10" align="center">No Data Found</td>
        </tr>
        @else
        {{-- */$x=0;
        $total = 0;
        $total_net_purchase = 0;
        /* --}}
        @foreach($transaction as $item)
        {{-- */
        	$x++;
           	$pr_sum = $item->pr_sum;
            $totalPayable = $item->payable - $pr_sum;
            $total += $item->selling_price_sum;
            $total_net_purchase += $totalPayable;
            /* --}}
         <tr>
            <td>{{ $x }}</td><td>{{ $item->invoice_ref }}</td>
            <td>{{ date("d-m-Y", strtotime($item->purchase_date)) }}</td><td>{{ $item->item_name }}</td>
            <td>{{ $item->brand_name }}</td><td>{{ $item->category_name }}</td>
            <td>{{ $item->suppliers_name }}</td>
            <td>Cash</td><td>{{ $item->payable }}</td>
            <td>{{ $pr_sum }}</td><td>{{ $totalPayable }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->selling_price_sum }}</td>
        </tr>
        
        @endforeach
        <tr>
            <td colspan="10" align="center"><b>Grand Total</b></td><td colspan="2"><b>{{ $total_net_purchase }}</b></td><td colspan="1"><b>{{ $total }}</b></td>
           
        </tr>
        @endif
    </table>
</div>


<button id="print_report">Print Report</button>






@endsection
