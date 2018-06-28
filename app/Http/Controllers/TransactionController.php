<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use App\Querymodels\QueryTransact;
use App\Inventories;
use Illuminate\Support\Facades\Auth;
use App\Discounts;

class TransactionController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request) {
    	$recipt = false;
    	$r_id = false;

    	$user_id = Auth::user()->id;
    	$transact = new QueryTransact();
    	$pending = $transact->getPenddingOrders($user_id);
    	if(!empty($pending)){
    		$old = true;
    	}else{
    		$old = false;
    	}
    	
    	$customers = $transact->getCustomers();
    	
    	if($request->session()->has('recipt'))$recipt = $request->session()->pull('recipt');
    	if($request->session()->has('r_id'))$r_id = $request->session()->pull('r_id');
    	
    	
    	
    	return view('transaction.index', compact('customers', 'pending', 'old', 'recipt', 'r_id'));
    }
    public function process(Request $request) {
    	$data = $request->all();
    	$user = $request->user();
    	$data['user_id'] = $user->id;
    	$data['confirm'] = 0;
    	$t = Transaction::create($data);
    	$insertedId = $t->id;
    	echo json_encode(['error'=>false,'insertedId'=>$insertedId]);
		exit;
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $bocde
     * @return Response
     */
    public function getItemPrice($bocde) {
    	$transact = new QueryTransact();
    	$user_id = Auth::user()->id;
    	$price = $transact->getBarcodeItemPrice($bocde, $user_id);
    	if(!$price){
    	echo json_encode(['error'=>true,'bocde'=>$bocde]);
		exit;
    	}
    	
    	echo json_encode(['error'=>false,'data'=>$price]);
		exit;
    }
    public function getbcode($bocde) {
    	$transact = new QueryTransact();
    	$barcode = $transact->getBarcodeItem($bocde);
    	if(!$barcode){
    		echo json_encode(['error'=>true,'bocde'=>$bocde]);
    		exit;
    	}
    	 
    	echo json_encode(['error'=>false,'data'=>$barcode, 'solditems'=>$transact->getItemSoledCount($barcode->id)]);
    	exit;
    }
    
    public function store(Request $request){
    	$recipt = $request->all();
     	$transact = new QueryTransact();
    	$user_id = Auth::user()->id;
    	$discount = $request->discount==''?0:$request->discount;
    	if($request->finish=='delete'){
    		$transact->deleteUserInventory($user_id);
    	}
    	else if($request->finish=='process'){
    		$bill = $transact->updatestock($user_id);
    		if($bill):
    		$change = $request->pay-($bill-$discount);
    		$storeTransaction = Transaction::create(['bill'=>$bill,'pay'=>$request->pay, 
    				'change'=>$change,'user_id'=>$user_id, 
    				'customer_id'=>$request->customer ]);
    		if($storeTransaction->id){
    			Inventories::where(['user_id'=> $user_id, 'status'=> 1])->update(['status' => 2, 'transaction_id'=> $storeTransaction->id]);
    			if($discount>0){
    				Discounts::create(['discount_type'=>1, 'discount_cent'=>0, 'discount_amount'=>$discount, 'transaction_id'=>$storeTransaction->id]);
    			}
    		}

    		$request->session()->put('recipt', $recipt);
    		$request->session()->put('r_id', $storeTransaction->id);
    		endif;
    		
    	}
    	return redirect('transaction');
    }

    public function trasnactionlist(){
    	$transaction = Transaction::orderBy('created_at', 'desc')->simplePaginate(20);
    	$transaction->setPath('');
    	return view('transaction.list', compact('transaction'));
    	
    }
    
    public function trasnactionPrint($transaction_id){
    	$trans = new QueryTransact();
    	$recipt = $trans->getTransactionItems($transaction_id);
    	$r_id = $transaction_id;
    	$urldata = ['discount'=>$_GET['discount'],'pay'=>$_GET['pay'],'change'=>$_GET['change'] ];

    	return view('transaction.show', compact('recipt', 'urldata', 'r_id'));
    	 
    }
    
    public function deleteitem($id){
    	$transact = new QueryTransact();
    	$user_id = Auth::user()->id;
    	$transact->deleteInventory($id, $user_id);
    	echo json_encode(['error'=>false,'id'=>$id]);
    	exit;
    }
    
    public function changeQuantity(Request $request){
    	$code = '';
    	$item_id = $request->item_id;
    	$new_qty = $request->new_qty;
    	$old_qty = $request->old_qty;
    	$qty_def = $new_qty - $old_qty;
    	if($new_qty == $old_qty || $new_qty<=0 || $old_qty<=0){
    		echo json_encode(['code'=>0]);
    		return;
    	}
    	$user_id = Auth::user()->id;
    	$transact = new QueryTransact();
    	$ct = $transact->getInventoryCount($item_id);
    	
    	if($qty_def>$ct){
    		echo json_encode(['code'=>1]);
    	}elseif($qty_def>0){
    		$p = $transact->getItemPriceSum($item_id, $qty_def, $user_id);
    		echo json_encode(['code'=>2, 'amount'=>$p, 'new_qty'=>$new_qty, 'item_id'=>$item_id]);
    	}elseif($qty_def<0){
    		$qty_def_abs = abs($qty_def);
    		$p = $transact->getItemPriceSub($item_id, $qty_def_abs, $user_id);
    		echo json_encode(['code'=>3, 'amount'=>-$p, 'new_qty'=>$new_qty, 'item_id'=>$item_id]);
    	}
    }
}
