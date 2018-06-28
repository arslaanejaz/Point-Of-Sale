<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Salereturns;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Querymodels\QueryTransact;
use App\Inventories;
use App\Querymodels\QueryReturn;
use App\TransactionReturn;


class SalereturnController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$transact = new QueryTransact();
		$customers = $transact->getCustomers();
		$inv = false;
		$salereturns = Salereturns::latest()->get();
		return view('salereturn.index', compact('salereturns', 'inv', 'customers'));
	}
	
	public function savePrint(Request $request)
	{
		if(!$request->ids){
			return redirect('salereturn');
		}
		$queryReturn = new QueryReturn();
		$queryTransact = new QueryTransact();
		
		$transaction_return = array();
		$item_ids = array();
		$inventories_ids = array();
		foreach($request->ids as $row){
			$ids = explode(',', $row);
			if(isset($item_ids[$ids[0]])){
				$item_ids[$ids[0]] += 1;
			}
			else {
				$item_ids[$ids[0]]=1;
			}
			$inventories_ids[] = $ids[1];
			
			$transaction_return[] = array('inventory_id'=>$ids[1], 
					'trans_purchase_id'=>$request->transaction_id, 
					'return_type'=>0,
					//'reason'=>$request->reason,
					//'customer_id'=>$request->customer_id,
					//'return_price'=>$request->return_price,
					'created_at'=>date('Y-m-d H:i:s')
			);
			
		}
		
		$data = $request->all();
		$user = $request->user();
		$data['user_id'] = $user->id;
		$data['sale_return_ids'] = serialize($inventories_ids);
		
		$salereturns = Salereturns::create($data);
		$saleReturnId = $salereturns->id;
		$queryReturn->setSaleReturn($inventories_ids, $saleReturnId);
		foreach($item_ids as $key=>$val){
			$queryTransact->stockAdded($key, $val);
		}
		
		TransactionReturn::insert($transaction_return);
		
		
		return redirect('salereturn');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$transact = new QueryTransact();
		$customers = $transact->getCustomers();
		return view('salereturn.create', compact('customers'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$transact = new QueryTransact();
		$customers = $transact->getCustomers();
		
		$salereturns = false;
		$transaction_id = $request->transaction_id;
		if($request->transaction_id)
			$inv = Inventories::where(['transaction_id'=>$request->transaction_id])->get();
		else $inv = false;
		$return_item = $transact->getReturnItem($transaction_id, 0);
		return view('salereturn.index', compact('salereturns', 'inv', 'customers', 'transaction_id', 'return_item'));
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$salereturn = Salereturns::findOrFail($id);
		return view('salereturn.show', compact('salereturn'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$salereturn = Salereturns::findOrFail($id);
		return view('salereturn.edit', compact('salereturn'));
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
		$salereturn = Salereturns::findOrFail($id);
		$salereturn->update($request->all());
		return redirect('salereturn');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Salereturns::destroy($id);
		return redirect('salereturn');
	}

}
