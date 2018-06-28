<?php
namespace App\Querymodels;
use DB;
class QueryReturn{
	

	public function getInventorySaleCount($item_id, $selling_price){
		return DB::table('inventories')
		->select(DB::raw('count(*) as ct'))
		->where('status', 2)
		->where('item_id', $item_id)
		->where('selling_price', $selling_price)
		->first()->ct;
	}
	


	
	public function setSaleReturn($ids, $saleReturnId){
		
			DB::table('inventories')
			->whereIn('id', $ids)
			->update(array('status' => 0, 'return_id'=>$saleReturnId, 'user_id'=>0, 'transaction_id'=>0));

	}
// 	public function setPurchaseReturn($ids, $saleReturnId){
	
// 		DB::table('inventories')
// 		->whereIn('id', $ids)
// 		->update(array('status' => 3, 'return_id'=>$saleReturnId));
	
// 	}
	
	
}