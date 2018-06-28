@extends('layouts.master')

@section('content')

    <h1>Salereturn</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Reason</th><th>Return Price</th><th>Date</th>
            </tr>
            <tr>
                <td>{{ $salereturn->id }}</td><td>{{ $salereturn->reason }}</td><td>{{ $salereturn->return_price }}</td><td>{{ $salereturn->created_at }}</td>
            </tr>
        </table>
    </div>

@endsection
