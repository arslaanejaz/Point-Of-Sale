@extends('layouts.master')

@section('content')

    <h1>Inventory</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Item Name</th>
            </tr>
            <tr>
                <td>{{ $inventory->id }}</td><td>{{ $inventory->item->item_name }}</td>
            </tr>
        </table>
    </div>

@endsection
