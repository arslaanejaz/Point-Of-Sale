@extends('layouts.master')

@section('content')

    <h1>Sale return Report <a href="{{ url('/reports') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <hr/>
{!! Form::open(['url' => 'reports/sale_return_report','method'=>'get', 'class' => 'form-inline']) !!}
    <div class="form-group">
        <label for="start_date">Start Sale Return Date</label>
        <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="Start Date" value="{{ isset($_GET['start_date'])?$_GET['start_date']:'' }}">
    </div>
    <div class="form-group">
        <label for="endingdate">Ending Sale Return Date</label>
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
            <th>Sale Type</th><th>Item Selling Price</th>
            <th>Transaction Bill</th><th>Transaction pay</th>
            <th>Transaction Change</th>
            
            <th>Sale Return Date</th>
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
            /* --}}
         <tr>
            <td>{{ $x }}</td><td>{{ $item->invoice_ref }}</td>
            <td>{{ date("d-m-Y", strtotime($item->purchase_date)) }}</td><td>{{ $item->item_name }}</td>
            <td>{{ $item->brand_name }}</td><td>{{ $item->category_name }}</td>
            <td>{{ $item->suppliers_name }}</td>
            <td>Cash</td><td>{{ $item->selling_price }}</td>
            <td>{{ $item->bill }}</td>
            <td>{{ $item->pay }}</td>
            <td>{{ $item->change }}</td>

             <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
            
        </tr>
        
        @endforeach

        @endif
    </table>
</div>


<button id="print_report">Print Report</button>






@endsection
