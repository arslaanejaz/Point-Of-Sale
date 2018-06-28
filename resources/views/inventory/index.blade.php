@extends('layouts.master')

@section('content')
<h1>Inventory</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SL.</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Purchase Price</th>
                <th>Sale Price</th>
                <th>Purchase Date</th>
                <th>Invoice Reference</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Sold</th>
                <th>Purchase Return</th>
                <th>In Stock</th>
            </tr>
            {{-- */$x=0;/* --}}
            @foreach($inventories as $item)
            {{-- */
            $saleItems = $item->sold_ct;
           	$purchaseReturns = $item->p_return_ct;
            $inStock = $item->unit_count - $purchaseReturns - $saleItems;
            /* --}}
                {{-- */$x++;/* --}}
                <tr>
                   <td>{{ $x }}</td>
                   <td>{{ $item->item_name }}</td>
                   <td>{{ $item->unit_price }}</td>
                   <td>{{ $item->unit_purchase_price }}</td>
                   <td>{{ $item->selling_price }}</td>
                   <td>{{ $item->purchase_date }}</td>
                   <td>{{ $item->invoice_ref }}</td>
                   <td>{{ $item->supplier }}</td>
                   <td>{{ $item->unit_count }}</td>
                   <td>{{ $saleItems }}</td>
                   <td>{{ $purchaseReturns }}</td>
                   <td>{{ $inStock }}</td>
                </tr>
            @endforeach
        </table>
    </div>
<div class="pagination"> {!! $inventories->render() !!} </div>
@endsection

