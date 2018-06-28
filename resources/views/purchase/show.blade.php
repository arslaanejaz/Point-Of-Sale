@extends('layouts.master')

@section('content')

    <h1>Purchase</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $purchase->id }}</td><td>{{ $purchase->item->item_name }} ({{ $purchase->item->item_number }})</td>
            </tr>
        </table>
    </div>

@endsection
