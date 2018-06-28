@extends('layouts.master')

@section('content')

<h1>Home</h1>
<hr/>
<div class="row">
    <h4><a href="{{ url('reports/sales_report') }}">General Sale Report</a> </h4>
    <h4><a href="{{ url('reports/sales_report_supplier') }}">General Sale Report By Supplier</a> </h4>
    <h4><a href="{{ url('reports/profit_loss_report') }}">Profit Loss Report</a> </h4>
    <h4><a href="{{ url('reports/purchase_return_report') }}">Purchase Return Report</a> </h4>
    <h4><a href="{{ url('reports/sale_return_report') }}">Sale Return Report</a> </h4>
</div>





@endsection
