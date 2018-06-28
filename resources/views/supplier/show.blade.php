@extends('layouts.master')

@section('content')

    <h1>Supplier View<a href="{{ url('/supplier') }}" class="btn btn-primary pull-right btn-sm">Back</a></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th>
                <th>Name</th>
                <th>Account Id</th>
                <th>CNIC</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Contact Person</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->account_id }}</td>
                <td>{{ $supplier->cnic }}</td>
                <td>{{ $supplier->city }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->mobile }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->contact_person }}</td>
                <td>{{ $supplier->created_at }}</td>
                <td>{{ $supplier->updated_at }}</td>
            </tr>
        </table>
    </div>

@endsection
