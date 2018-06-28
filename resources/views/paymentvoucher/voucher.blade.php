@extends('layouts.master')

@section('content')

    <h1>Payment Vouchers <a href="{{ url('/paymentvoucher') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Invoice reference #</th><th>Payment</th><th>Payment Type</th><th>Bank Name</th><th>Cheque Number</th><th>Payment Date</th><th>Record Created At</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($paymentvoucher as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->invoice_ref }}</td>
                    <td>{{ $item->payment }}</td>
                    <td>{{ $payment_type[$item->type] }}</td>
                    <td>{{ $item->bank_name }}</td>
                    <td>{{ $item->cheque_no }}</td>
                    <td>{{ $item->payment_date }}</td>
                    <td>{{ $item->created_at }}</td>
                    </tr>
            @endforeach
        </table>
    </div>

@endsection
