<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Purchases;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Querymodels\QueryTransact;
use App\Inventories;
use App\Paymentvouchers;

class PurchaseController extends Controller
{
	private $inventory = array();

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$purchases = Purchases::latest()->get();
		return view('purchase.index', compact('purchases'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$transact = new QueryTransact();
		$suppliers  = $transact->getSuppliers();
		return view('purchase.create', compact('suppliers'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
				'item_id' => 'required', 
				'unit_count'=>'required|numeric|max:5000|min:1', 
				'selling_price'=>'required|numeric',
				'payable'=>'required|numeric',
				'unit_price'=>'required|numeric',
				'unit_price_with_tax'=>'numeric',
				'selling_price'=>'required|numeric',
				'paid_price'=>'numeric',
				'invoice_ref'=>'required|max:32',
				'remarks'=>'max:255',
				
		],
				['unit_count.required'=>'Quantity Is Required',
						'unit_count.numeric'=>'Quantity should only be in numbers',
						'unit_count.max'=>'Quantity cannot be grater than 5000',
						'unit_count.min'=>'Quantity cannot be less than 1',
						'item_id.required'=>'Please select item first',
				]);
		
		$item_id = $request->item_id;
		$selling_price = $request->selling_price;
		$supplier_id = $request->supplier_id;
		$unit_count = $request->unit_count;

		$purchases = Purchases::create($request->all());
		$purchase_id = $purchases->id;

		$this->setInventory($item_id, $selling_price, $supplier_id, $unit_count, $purchase_id);
		
		Inventories::insert($this->inventory);
		
		//payment voucher insert
			$pv_count = Paymentvouchers::where('invoice_ref',$request->invoice_ref)->count();
			if($pv_count==0){
				Paymentvouchers::create(['invoice_ref'=>$request->invoice_ref,
						'payment'=>$request->paid_price, 'type'=>0, 'bank_name'=>'', 
						'cheque_no'=>'', 'payment_date'=>$request->purchase_date]);
			}elseif($request->paid_price>0){
				Paymentvouchers::create(['invoice_ref'=>$request->invoice_ref,
						'payment'=>$request->paid_price, 'type'=>0, 'bank_name'=>'', 
						'cheque_no'=>'', 'payment_date'=>$request->purchase_date]);
			}
		
		
		
		$queryTransact = new QueryTransact();
		$queryTransact->stockAdded($item_id, $unit_count);
		return redirect('purchase');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$purchase = Purchases::findOrFail($id);
		return view('purchase.show', compact('purchase'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$purchase = Purchases::findOrFail($id);
		$transact = new QueryTransact();
		$suppliers  = $transact->getSuppliers();
		return view('purchase.edit', compact('purchase', 'suppliers'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$queryTransact = new QueryTransact();
		$this->validate($request, 
				['selling_price' => 'required', 
						'unit_count'=>'required|numeric|max:5000|min:1'], 
				['unit_count.max'=>'Quantity cannot be grater than 5000', 
						'unit_count.min'=>'Quantity cannot be less than 1']); // Uncomment and modify if needed.
		$purchase = Purchases::findOrFail($id);
		
		if($purchase->unit_count > $request->unit_count){
			//subtract
			$limit = $purchase->unit_count - $request->unit_count;
			$ct = $queryTransact->getInventoryPurchaseCount($purchase->id);
			if($ct<$limit){
				$val = $ct;
				$minval = $purchase->unit_count - $ct;
				return redirect('purchase/'.$purchase->id.'/edit')->withErrors(["Can not update because $val items are available in stock for this purchase, You can't put value less than $minval"]);
			}
			
			$queryTransact->removeInventory($purchase->item_id, $limit);
			$queryTransact->stockRemove($purchase->item_id, $limit);
		}elseif($purchase->unit_count < $request->unit_count){
			//add
			$item_id = $purchase->item_id;
			$selling_price = $request->selling_price;
			$supplier_id = $purchase->supplier_id;
			$unit_count =  $request->unit_count - $purchase->unit_count;
			$purchase_id = $purchase->id;
			$this->setInventory($item_id, $selling_price, $supplier_id, $unit_count, $purchase_id);
			Inventories::insert($this->inventory);
			$queryTransact->stockAdded($item_id, $unit_count);
		}
		
		$purchase->update($request->all());
		$queryTransact->updateUnitPricePurchase($request->item_id, $request->selling_price);
		
		
		return redirect('purchase');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		die('blocked');
		//Purchases::destroy($id);
		//return redirect('purchase');
	}
	
	private function setInventory($item_id, $selling_price, $supplier_id, $unit_count, $purchase_id){
		for($i=0;$i<$unit_count;$i++){
			$this->inventory[] = array(
					'item_id'=>$item_id,
					'selling_price'=>$selling_price,
					'supplier_id'=>$supplier_id,
					'purchase_id'=>$purchase_id,
					'transaction_id'=>0,
					'return_id'=>0,
					'user_id'=>0,
					'status'=>0
			);
		}
	}

}
