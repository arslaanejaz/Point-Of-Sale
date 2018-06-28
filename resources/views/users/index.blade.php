@extends('layouts.master')

@section('content')

    <h1>Users <a href="{{ url('/users/create') }}" class="btn btn-primary pull-right btn-sm">Add New Users</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th><th>Name</th><th>Actions</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/users', $item->id) }}">{{ $item->name }}</a></td>
                    <td><a href="{{ url('/users/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Update</button></a></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
