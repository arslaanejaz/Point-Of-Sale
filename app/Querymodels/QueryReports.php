<?php
namespace App\Querymodels;
use DB;
class QueryReports{

 public function getSalesReport(){
 	$where = "where inventories.status=2";
     if(isset($_GET['start_date']) && $_GET['start_date'] !='')
     {
       $start_date =  $_GET['start_date'];
       $end_date = $_GET['end_date'];
       $start_date = date("Y-m-d", strtotime($start_date));
       $end_date = date("Y-m-d", strtotime($end_date));
       $where.= " && purchases.purchase_date>='".$start_date."' && purchases.purchase_date<='".$end_date."'";
       $sales = DB::select("select purchases.invoice_ref,purchases.supplier_id,purchases.purchase_date,suppliers.name suppliers_name, items.item_name,
  		brands.name as brand_name, categories.name as category_name, sum(inventories.selling_price) selling_price_sum, count(inventories.id) as qty
  		from purchases
		inner join suppliers on suppliers.id=purchases.supplier_id
		inner join items on items.id=purchases.item_id
		inner join categories on categories.id=items.category
		inner join brands on brands.id=items.brand
		left join inventories on inventories.purchase_id=purchases.id
		".$where."
		group by purchases.id");
       return $sales;
     }else{
     	return false;
     }
 
 }
    public function getSalesReportSupplier(){
    $where = "where inventories.status=2";
     if(isset($_GET['start_date']) && $_GET['start_date'] !='' && $_GET['supplier_id'] !='')
     {
       $start_date =  $_GET['start_date'];
       $end_date = $_GET['end_date'];
       $start_date = date("Y-m-d", strtotime($start_date));
       $end_date = date("Y-m-d", strtotime($end_date));
       $supplier_id = $_GET['supplier_id'];
       $where.= "&& purchases.supplier_id=".$supplier_id." && purchases.purchase_date>='".$start_date."' && purchases.purchase_date<='".$end_date."'";
       $sales = DB::select("select purchases.invoice_ref,purchases.supplier_id,purchases.purchase_date,suppliers.name suppliers_name, items.item_name,
  		brands.name as brand_name, categories.name as category_name, sum(inventories.selling_price) selling_price_sum, count(inventories.id) as qty
  		from purchases
		inner join suppliers on suppliers.id=purchases.supplier_id
		inner join items on items.id=purchases.item_id
		inner join categories on categories.id=items.category
		inner join brands on brands.id=items.brand
		left join inventories on inventories.purchase_id=purchases.id
		".$where."
		group by purchases.id");
       return $sales;
     }else{
     	return false;
     }
    }
    
    public function getProfitLossReport(){
    	$where = "";
    	if(isset($_GET['start_date']) && $_GET['start_date'] !='')
    	{
    		$start_date =  $_GET['start_date'];
    		$end_date = $_GET['end_date'];
    		$start_date = date("Y-m-d", strtotime($start_date));
    		$end_date = date("Y-m-d", strtotime($end_date));
    		$where.= " where purchases.purchase_date>='".$start_date."' && purchases.purchase_date<='".$end_date."'";
    		$sales = DB::select("select purchases.id,purchases.invoice_ref,purchases.purchase_date,purchases.unit_purchase_price,suppliers.name suppliers_name, items.item_name,
brands.name as brand_name, categories.name as category_name, sum(inventories.selling_price) selling_price_sum, count(inventories.id) as qty
from purchases
inner join suppliers on suppliers.id=purchases.supplier_id
inner join items on items.id=purchases.item_id
inner join categories on categories.id=items.category
inner join brands on brands.id=items.brand
left join inventories on inventories.purchase_id=purchases.id && inventories.status=2
".$where."
group by purchases.id");
    		return $sales;
    	}else{
    		return false;
    	}
    
    }
    
    public function getPurchaseReturnReport(){
    	$where = "";
    	if(isset($_GET['start_date']) && $_GET['start_date'] !='')
    	{
    		$start_date =  $_GET['start_date'];
    		$end_date = $_GET['end_date'];
    		$start_date = date("Y-m-d", strtotime($start_date));
    		$end_date = date("Y-m-d", strtotime($end_date));
    		$where.= " where purchases.purchase_date>='".$start_date."' && purchases.purchase_date<='".$end_date."'";
    		$sales = DB::select("select purchases.id,purchases.invoice_ref,purchases.purchase_date,purchases.payable,suppliers.name suppliers_name, items.item_name,
brands.name as brand_name, categories.name as category_name, sum(inventories.selling_price) selling_price_sum, count(inventories.id) as qty, pr_sum
from purchases
inner join suppliers on suppliers.id=purchases.supplier_id
inner join items on items.id=purchases.item_id
inner join categories on categories.id=items.category
inner join brands on brands.id=items.brand
inner join (select sum(purchasereturns.return_price) as pr_sum, purchasereturns.purchase_id as pr_id from purchasereturns group by purchasereturns.purchase_id)
sumofpr on purchases.id=sumofpr.pr_id
left join inventories on inventories.purchase_id=purchases.id && inventories.status=2
".$where."
group by purchases.id");
    		return $sales;
    	}else{
    		return false;
    	}
    
    }
    
    public function getSaleReturnReport(){
    	/*
    	 four tables involed
    	 1. {purchase} table is related to inventories table {id} to {purchase_id} respectively
    	 2. {inventories} table is related to {saleterurn} table {return_id} to {id} respectively
    	 3. inventories table is related to {transaction_return} inventories.id=transaction_return.inventory_id 
    	 4. AND {transaction} table is related to transaction_return transaction.id=transaction_return.trans_purchase_id
    	 
    	 */
    	
    	$where = "";
    	if(isset($_GET['start_date']) && $_GET['start_date'] !='')
    	{
    		$start_date =  $_GET['start_date'];
    		$end_date = $_GET['end_date'];
    		$start_date = date("Y-m-d", strtotime($start_date));
    		$end_date = date("Y-m-d", strtotime($end_date));
    		$where.= " where DATE(transaction_return.created_at)>='".$start_date."' && DATE(transaction_return.created_at)<='".$end_date."'";
    		$sales = DB::select("SELECT 
			purchases.invoice_ref,purchases.purchase_date,
			suppliers.name suppliers_name, items.item_name,
			brands.name as brand_name, 
			categories.name as category_name, 
			inventories.selling_price,
			transaction.bill, transaction.pay, transaction.change,
    		transaction_return.created_at
			FROM `transaction` 
			inner join transaction_return on transaction_return.trans_purchase_id=transaction.id 
			left join inventories on inventories.id=transaction_return.inventory_id
			inner join purchases on purchases.id=inventories.purchase_id
			inner join suppliers on suppliers.id=purchases.supplier_id
			inner join items on items.id=purchases.item_id
			inner join categories on categories.id=items.category
			inner join brands on brands.id=items.brand
			".$where);
    		return $sales;
    		
    	}else{
    		return false;
    	}
    
    }



}