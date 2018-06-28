@extends('layouts.master')

@section('content')

<h1>Transaction List</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Bill</th><th>Pay</th><th>Change</th><th>User</th><th>Customer</th><th>Discount</th><th>Created At</th><th>Print</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($transaction as $item)
                {{-- */$x++;
                if($item->discount)$discount = $item->discount->discount_amount;
            else $discount = 0;
                /* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->bill }}</a></td>
                    <td>{{ $item->pay }}</td>
                    <td>{{ $item->change }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->customer->name }}</td>
                    <td>{{ $discount }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td><a href="{{ url('/transaction/trasnactionprint/'.$item->id.'?discount='.$discount.'&change='.$item->change.'&pay='.$item->pay) }}" class="btn btn-primary btn-sm">Print</a></td>
                </tr>
            @endforeach
        </table>
    </div>

<div class="pagination"> {!! $transaction->render() !!} </div>
@endsection