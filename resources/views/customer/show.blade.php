@extends('layouts.master')

@section('content')

    <h1>Customer</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $customer->id }}</td><td>{{ $customer->name }}</td>
            </tr>
        </table>
    </div>

@endsection
