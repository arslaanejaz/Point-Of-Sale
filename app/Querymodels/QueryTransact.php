<?php
namespace App\Querymodels;
use DB;
class QueryTransact{
	
	private $stockupdate = array();
	private $itemsWithQty = array();
	private $bill = 0;
	private $change = 0;
	
	public function getInventoryCount($item_id){
		return DB::table('inventories')
		->select(DB::raw('count(*) as ct'))
		->where('status', 0)
		->where('item_id', $item_id)
		->first()->ct;
	}
	public function getItemSoledCount($item_id){
		return DB::table('inventories')
		->select(DB::raw('count(*) as ct'))
		->where('status', 2)
		->where('item_id', $item_id)
		->first()->ct;
	}
	
	public function getBarcodeItemPrice($bocde, $user_id) {
		$barcode = DB::table('items')->select('id', 'item_name')->where('item_number', $bocde)->first();
		if($barcode)
		$price = DB::table('inventories')->select('id','item_id','selling_price')->where('item_id',$barcode->id)->where('status',0)->take(1)->first();
		else return false;
		if($price){
		DB::table('inventories')->where('id',$price->id)->update(['user_id'=>$user_id,'status'=>1]);
		return array('item_id'=>$price->item_id,'item_name'=>$barcode->item_name,'selling_price'=>$price->selling_price);
		}
		else return false;
	}
	public function getItemPriceSum($item_id, $limit, $user_id){
		$results = DB::select('select sum(selling_price) as price from 
				(select selling_price from inventories where item_id = :item_id && status=0 && user_id=0 limit :limit) as price', 
				['item_id' => $item_id, 'limit' => $limit]);
		DB::update(DB::raw("UPDATE inventories SET status=1, user_id=".$user_id." 
         WHERE id IN (
         SELECT id FROM (
             SELECT id FROM inventories
			 WHERE item_id=".$item_id." && status=0 
             LIMIT ".$limit."
         ) tmp
        )"));
		if($results)
		return $results[0]->price;
		else return false;
	}
	public function getItemPriceSub($item_id, $limit, $user_id){
		$results = DB::select('select sum(selling_price) as price from
				(select selling_price from inventories where item_id = :item_id && user_id = :user_id && status=1 ORDER BY id DESC limit :limit) as price',
				['item_id' => $item_id, 'limit' => $limit, 'user_id'=>$user_id]);
		DB::update(DB::raw("UPDATE inventories SET status=0, user_id=0
         WHERE id IN (
         SELECT id FROM (
             SELECT id FROM inventories
			 WHERE item_id=".$item_id." && user_id=".$user_id." && status=1
			 ORDER BY id DESC 
             LIMIT ".$limit."
         ) tmp
        )"));
		if($results)
		return $results[0]->price;
		else return false;
	}
	public function deleteInventory($item_id, $user_id){
		DB::table('inventories')
		->where('item_id',$item_id)
		->where('user_id',$user_id)
		->where('status',1)
		->update(['status'=>0,'user_id'=>0]);
	}
	public function deleteUserInventory($user_id){
		DB::table('inventories')
		->where('user_id',$user_id)
		->where('status',1)
		->update(['status'=>0,'user_id'=>0]);
	}
	public function getBarcodeItem($bocde) {
		$barcode = DB::table('items')->select('id', 'item_name', 'quantity_in_stock')->where('item_number', $bocde)->first();
		return $barcode;
	}
	
	
	public function getCustomers(){
		$customers =  DB::table('customers')->lists('name','id');
		return $customers;
	}
	
	public function getSuppliers(){
		$suppliers =  DB::table('suppliers')->lists('name','id');
		//return array(''=>'select')+
		return $suppliers;
	}
	
	public function getCategory(){
		$suppliers =  DB::table('categories')->lists('name','id');
		return $suppliers;
	}
	public function getBrands(){
		$suppliers =  DB::table('brands')->lists('name','id');
		return $suppliers;
	}
	public function getVoucherRef(){
		$firstItem = array('' => 'Select');
		$suppliers =  DB::table('paymentvouchers')->distinct()->lists('invoice_ref', 'invoice_ref');
		return $firstItem+$suppliers;
	}
	
	public function getPayablePrice($invoice_ref){
		return DB::table('purchases')
		//->select('payable')
		->where('invoice_ref', $invoice_ref)
		->groupBy('invoice_ref')
		->sum('payable');
	}
	
	
	public function updatestock($user_id){
		
		$this->getPenddingOrders($user_id);
		
		
		foreach($this->itemsWithQty as $key=>$val){
			$this->bill += $val['amount'];
			
			DB::table('items')
			->where('id', $key)
			->decrement('quantity_in_stock',$val['qty']);
		}
		
		return $this->bill;
	}
	
	public function stockAdded($id, $val){
		DB::table('items')
		->where('id', $id)
		->increment('quantity_in_stock',$val);
		
	}
	public function stockRemove($id, $val){
		DB::table('items')
		->where('id', $id)
		->decrement('quantity_in_stock',$val);
	
	}
	
	public function getPenddingOrders($user_id){
		$d =  DB::table('inventories')
            ->join('items', 'inventories.item_id', '=', 'items.id')
            ->select('inventories.item_id as item_id', 
            		'inventories.selling_price as selling_price', 
            		'items.item_name as item_name'
            		)
            ->where('status', 1)
            ->where('user_id', $user_id)
            ->get();
		if($d){
		foreach($d as $row){
			if(isset($this->itemsWithQty[$row->item_id])){
			$this->itemsWithQty[$row->item_id]['qty'] += 1;
			$this->itemsWithQty[$row->item_id]['amount'] += $row->selling_price;
			}else{
				$this->itemsWithQty[$row->item_id]['qty'] = 1;
				$this->itemsWithQty[$row->item_id]['amount'] = $row->selling_price;
			}
			$this->itemsWithQty[$row->item_id]['name'] = $row->item_name;
		}
		return $this->itemsWithQty;
		}else {return false;}
	}
	
	public function getTransactionItems($transaction_id){
		$d =  DB::table('inventories')
		->join('items', 'inventories.item_id', '=', 'items.id')
		->select('inventories.item_id as item_id',
				'inventories.selling_price as selling_price',
				'items.item_name as item_name'
		)
		->where('transaction_id', $transaction_id)
		->get();
		if($d){
			foreach($d as $row){
				if(isset($this->itemsWithQty[$row->item_id])){
					$this->itemsWithQty[$row->item_id]['qty'] += 1;
					$this->itemsWithQty[$row->item_id]['amount'] += $row->selling_price;
				}else{
					$this->itemsWithQty[$row->item_id]['qty'] = 1;
					$this->itemsWithQty[$row->item_id]['amount'] = $row->selling_price;
				}
				$this->itemsWithQty[$row->item_id]['name'] = $row->item_name;
			}
			return $this->itemsWithQty;
		}else {return false;}
	}
	
	public function getReturnItem($id, $type){
		if($type==0){
			$query =  DB::table('transaction_return')
			->join('inventories', 'transaction_return.inventory_id', '=', 'inventories.id')
			->join('items', 'inventories.item_id', '=', 'items.id')
			->select('items.item_name as item_name',
					'inventories.selling_price as selling_price'
			)
			->where('transaction_return.return_type', 0)
			->where('transaction_return.trans_purchase_id', $id)
			->get();
			return $query;
		}else{
			$query =  DB::table('transaction_return')
			->join('inventories', 'transaction_return.inventory_id', '=', 'inventories.id')
			->join('items', 'inventories.item_id', '=', 'items.id')
			->Join('purchases', 'inventories.purchase_id', '=', 'purchases.id')
			->select('items.item_name as item_name',
					'purchases.unit_price_with_tax as unit_price_with_tax'
			)
			->where('transaction_return.return_type', 1)
			->where('transaction_return.trans_purchase_id', $id)
			->get();
			return $query;
		}
		
	}
	
	public function updateUnitPricePurchase($purchase_id, $selling_price){
		DB::table('inventories')
		->where('purchase_id',$purchase_id)
		->where('status',0)
		->update(['selling_price'=>$selling_price]);
	}
	
	public function removeInventory($purchase_id, $limit){

		DB::delete("delete from inventories where purchase_id=$purchase_id and status=0 limit $limit");
	}
	
	public function getInventoryPurchaseCount($purchase_id){
		return DB::table('inventories')
		->select(DB::raw('count(*) as ct'))
		->where('status', 0)
		->where('purchase_id', $purchase_id)
		->first()->ct;
	}
	
	public function setPurchaseReturn($purchase_id, $limit){
		
		DB::update(DB::raw("UPDATE inventories SET status=3, user_id=0
         WHERE id IN (
         SELECT id FROM (
             SELECT id FROM inventories
			 WHERE purchase_id=".$purchase_id." && status=0
			 ORDER BY id DESC
             LIMIT ".$limit."
         ) tmp
        )"));
	}
	
}