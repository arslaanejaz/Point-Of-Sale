@extends('layouts.master')

@section('content')

    <h1>Items <a href="{{ url('/item/create') }}" class="btn btn-primary pull-right btn-sm">Add New Item</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Name</th><th>Quantity In Stock</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($items as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/item', $item->id) }}">{{ $item->item_name }}</a></td>
                    <td>{{ $item->quantity_in_stock }}</td>
                    <td><a href="{{ url('/item/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
