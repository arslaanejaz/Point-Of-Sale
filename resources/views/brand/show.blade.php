@extends('layouts.master')

@section('content')

    <h1>Brand</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $brand->id }}</td><td>{{ $brand->name }}</td>
            </tr>
        </table>
    </div>

@endsection
