<?php
namespace App\Querymodels;
use DB;
class QueryInventory{
public function getInventory(){
	return DB::table('inventory_stock')->simplePaginate(40);
}	
public function getInventoryByInvoice($invoice_ref){
	return DB::table('inventory_stock')->where('invoice_ref',$invoice_ref)->get();
}
}