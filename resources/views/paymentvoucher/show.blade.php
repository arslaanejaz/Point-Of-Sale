@extends('layouts.master')

@section('content')

    <h1>Paymentvoucher</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $paymentvoucher->id }}</td><td>{{ $paymentvoucher->name }}</td>
            </tr>
        </table>
    </div>

@endsection
