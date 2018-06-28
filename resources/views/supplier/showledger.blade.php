@extends('layouts.master')

@section('content')
    <h1>Supplier Ledger <a href="{{ url('/supplier') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <hr/>
{!! Form::open(['url' => 'supplier/ledger/'.$id,'method'=>'get', 'class' => 'form-inline']) !!}
    <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="Start Date" value="{{ isset($_GET['start_date'])?$_GET['start_date']:'' }}">
    </div>
    <div class="form-group">
        <label for="endingdate">Ending Date</label>
        <input type="text" class="form-control datepicker" id="endingdate" name="end_date" placeholder="Ending Date" value="{{ isset($_GET['end_date'])?$_GET['end_date']:'' }}">
    </div>
    <button type="submit" class="btn btn-default">Enter</button>
    {!! Form::close() !!}
</hr>
<br /><br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="printTable">
            <tr>
                <th>ID.</th>
                <th>Invoice Number</th>
                <th>Name</th>
                <th>Date Of Purchase</th>
                
                <th>Payables</th>
                <th>Purchase Return</th>
                <th>Paid</th>
                <th>Balance</th>
            </tr>
             {{-- */$x=0;/* --}}
            @foreach($ledger as $row)
                {{-- */$x++;/* --}}
                {{-- */
            $pv_sum = $row->pv_sum;
           	$pr_sum = $row->pr_sum;
            $totalPayable = $row->payable - $pr_sum;
            $balance =  $totalPayable - $pv_sum;
            /* --}}
            <tr>
                <td>{{ $x }}</td>
                <td>{{ $row->invoice_ref }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ date("d-m-Y", strtotime($row->purchase_date)) }}</td>
                
                <td>{{ $row->payable }}</td>
                <td>{{ $pr_sum }}</td>
                <td>{{ $pv_sum }}</td>
                <td>{{ $balance }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    
    <button id="print_report">Print Report</button>

@endsection
