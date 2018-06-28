@extends('layouts.master')

@section('content')

    <h1>Category</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $category->id }}</td><td>{{ $category->name }}</td>
            </tr>
        </table>
    </div>

@endsection
