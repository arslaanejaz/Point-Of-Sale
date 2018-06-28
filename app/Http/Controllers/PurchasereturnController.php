<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Purchasereturns;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Querymodels\QueryTransact;
use App\Inventories;
use App\Querymodels\QueryReturn;
use App\TransactionReturn;
use App\Querymodels\QueryInventory;
use App\Purchases;

class PurchasereturnController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$transact = new QueryTransact();
		//$suplier = $transact->getSuppliers();
		$inv = false;
		//$purchasereturns = Purchasereturns::latest()->get();
		
		if(isset($_GET['invoice_ref']) && $_GET['invoice_ref']!=''){
			$inventory = new QueryInventory();
			
			$invoice_ref = $_GET['invoice_ref'];
			if($invoice_ref)
				$inv = $inventory->getInventoryByInvoice($invoice_ref);
			else $inv = false;
			return view('purchasereturn.index', compact( 'inv', 'purchase_id', 'invoice_ref'));
		}
		
		return view('purchasereturn.index', compact('inv'));
	}
	
	public function returnItems($id, $in_stock){
		$purchase = Purchases::findOrFail($id);
		return view('purchasereturn.returnitems', compact('inv', 'in_stock', 'purchase'));
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('purchasereturn.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['return_item_count' => 'required|numeric', 'return_price'=>'required|numeric']); // Uncomment and modify if needed.

		//$queryReturn = new QueryReturn();
		$queryTransact = new QueryTransact();
		
// 		$transaction_return = array();
// 		$item_ids = array();
// 		$inventories_ids = array();
// 		foreach($request->ids as $row){
// 			$ids = explode(',', $row);
// 			if(isset($item_ids[$ids[0]])){
// 				$item_ids[$ids[0]] += 1;
// 			}
// 			else {
// 				$item_ids[$ids[0]]=1;
// 			}
// 			$inventories_ids[] = $ids[1];
		
// 			$transaction_return[] = array('inventory_id'=>$ids[1], 'trans_purchase_id'=>$request->purchase_id, 'return_type'=>1);
		
// 		}
		
		//$data = $request->all();
		//$user = $request->user();
		//$data['user_id'] = $user->id;
		
		//$purchasereturns = Purchasereturns::create($data);
		//$purchaseReturnsId = $purchasereturns->id;
		//$queryReturn->setPurchaseReturn($inventories_ids, $purchaseReturnsId);
		//foreach($item_ids as $key=>$val){
			//$queryTransact->stockRemove($key, $val);
		//}
		$queryTransact->setPurchaseReturn($request->purchase_id, $request->return_item_count);
		$queryTransact->stockRemove($request->item_id, $request->return_item_count);
		Purchasereturns::create($request->all());
		
		
		return redirect('purchasereturn?invoice_ref='.$request->invoice_ref);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$purchasereturn = Purchasereturns::findOrFail($id);
		return view('purchasereturn.show', compact('purchasereturn'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$purchasereturn = Purchasereturns::findOrFail($id);
		return view('purchasereturn.edit', compact('purchasereturn'));
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
		$purchasereturn = Purchasereturns::findOrFail($id);
		$purchasereturn->update($request->all());
		return redirect('purchasereturn');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Purchasereturns::destroy($id);
		return redirect('purchasereturn');
	}

}
