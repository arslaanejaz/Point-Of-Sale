@extends('layouts.master')

@section('content')

    <h1>Purchases <a href="{{ url('/purchase/create') }}" class="btn btn-primary pull-right btn-sm">Add New Purchase</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Name</th><th>Purchase Slip Number</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($purchases as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/purchase', $item->id) }}">{{ $item->item->item_name }} ({{ $item->item->item_number }})</a></td>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('/purchase/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
