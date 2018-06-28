<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Suppliers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Querymodels\QuerySupplier;

class SupplierController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$suppliers = Suppliers::latest()->get();
		return view('supplier.index', compact('suppliers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('supplier.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Suppliers::create($request->all());
		return redirect('supplier');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$supplier = Suppliers::findOrFail($id);
		return view('supplier.show', compact('supplier'));
	}
	
	/**
	 * Display the specified resource in detail.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showLedger($id)
	{
		$supplier = Suppliers::findOrFail($id);
		$querySupplier = new QuerySupplier();
		$ledger = $querySupplier->getSupplierLedger($id);
		return view('supplier.showledger', compact('supplier', 'ledger', 'id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$supplier = Suppliers::findOrFail($id);
		return view('supplier.edit', compact('supplier'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$supplier = Suppliers::findOrFail($id);
		$supplier->update($request->all());
		return redirect('supplier');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		die('Blocked...');
		//Suppliers::destroy($id);
		//return redirect('supplier');
	}

}
