@extends('layouts.master')

@section('content')

    <h1>Payment Vouchers <a href="{{ url('/paymentvoucher/create') }}" class="btn btn-primary pull-right btn-sm">Add New Paymentvoucher</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Voucher Number</th><th>Total Amount</th><th>Total Paid</th><th>Purchase Return</th><th>Balance</th><th>Action</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($paymentvouchers as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/paymentvoucher/getvoucher/'.$item->invoice_ref) }}">{{ $item->invoice_ref }}</a></td>
                    <td>{{ $item->payable_sum }}</td>
                    <td>{{ $item->pv_sum }}</td>
                    <td>{{ $item->pr_sum }}</td>
                    <td>{{ $item->payable_sum - ($item->pv_sum + $item->pr_sum) }}</td>
                    <td><a href="{{ url('/paymentvoucher/create?id='.$item->invoice_ref) }}">Add New Payment</a></td>
                    </tr>
            @endforeach
        </table>
    </div>

@endsection
