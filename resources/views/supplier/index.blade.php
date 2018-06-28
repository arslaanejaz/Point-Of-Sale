@extends('layouts.master')

@section('content')

    <h1>Suppliers <a href="{{ url('/supplier/create') }}" class="btn btn-primary pull-right btn-sm">Add New Supplier</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Name</th><th>CNIC</th><th>Phone</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($suppliers as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/supplier/ledger', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->cnic }}</td>
                    <td>{{ $item->phone }}</td>
                    <td><a href="{{ url('/supplier/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a>
                     | 
                     <a href="{{ url('/supplier/'.$item->id) }}"><button type="submit" class="btn btn-primary btn-xs">View</button></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
