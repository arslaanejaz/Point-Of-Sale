@extends('layouts.master')

@section('content')

    <h1>Customers <a href="{{ url('/customer/create') }}" class="btn btn-primary pull-right btn-sm">Add New Customer</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Name</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($customers as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/customer', $item->id) }}">{{ $item->name }}</a></td>
                    <td><a href="{{ url('/customer/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a> 
                    <!--/   {!! Form::open(['method'=>'delete','action'=>['CustomerController@destroy',$item->id], 'style' => 'display:inline']) !!}<button type="submit" class="btn btn-danger btn-xs">Delete</button>{!! Form::close() !!}--></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
