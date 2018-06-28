<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Querymodels\QueryInventory;

class InventoryController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$inv = new QueryInventory();
		$inventories = $inv->getInventory();
		$inventories->setPath('');
		return view('inventory.index', compact('inventories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		die('blocked...');
		return view('inventory.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		die('blocked...');
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Inventories::create($request->all());
		return redirect('inventory');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		die('blocked...');
		$inventory = Inventories::findOrFail($id);
		return view('inventory.show', compact('inventory'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		die('blocked...');
		$inventory = Inventories::findOrFail($id);
		return view('inventory.edit', compact('inventory'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		die('blocked...');
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$inventory = Inventories::findOrFail($id);
		$inventory->update($request->all());
		return redirect('inventory');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		die('blocked...');
		Inventories::destroy($id);
		return redirect('inventory');
	}

}
