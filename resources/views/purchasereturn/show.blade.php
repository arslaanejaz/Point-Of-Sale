@extends('layouts.master')

@section('content')

    <h1>Purchasereturn</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $purchasereturn->id }}</td><td>{{ $purchasereturn->name }}</td>
            </tr>
        </table>
    </div>

@endsection
