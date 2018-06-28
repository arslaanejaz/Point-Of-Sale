@extends('layouts.master')

@section('content')

    <h1>Item</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th><th>Description</th><th>Barcode</th><th>Quantity In Stock</th>
            </tr>
            <tr>
                <td>{{ $item->id }}</td><td>{{ $item->item_name }}</td><td>{{ $item->description }}</td><td>{{ $item->item_number }}</td><td>{{ $item->quantity_in_stock }}</td>
            </tr>
        </table>
    </div>

@endsection
