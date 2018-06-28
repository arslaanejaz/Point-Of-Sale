<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Items;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Querymodels\QueryTransact;

class ItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Items::latest()->get();
		return view('item.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$queryTransact = new QueryTransact();
        $category =  $queryTransact->getCategory();
        $brands=  $queryTransact->getBrands();
		return view('item.create',compact('category','brands'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$messages = [
				'item_number.unique' => 'Barcode should be unique, This barcode is already used.',
		];
		$this->validate($request, ['item_name' => 'required|unique:items', 
				'item_number' => 'required|unique:items', 
				'quantity_in_stock'=>'numeric'], 
				$messages);
		Items::create($request->all());
		return redirect('item');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = Items::findOrFail($id);
		return view('item.show', compact('item'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $queryTransact = new QueryTransact();
        $category =  $queryTransact->getCategory();
        $brands=  $queryTransact->getBrands();
        $item = Items::findOrFail($id);
		return view('item.edit', compact('item','category','brands'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$messages = [
				'item_number.unique' => 'Barcode should be unique, This barcode is already used.',
		];
		$this->validate($request, ['item_name' => "required|unique:items,item_name,$id", 
				'item_number' => "required|unique:items,item_number,$id", 
				'quantity_in_stock'=>'numeric'
		], 
				$messages);
		$item = Items::findOrFail($id);
		$item->update($request->all());
		return redirect('item');
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
		//Items::destroy($id);
		//return redirect('item');
	}

}
