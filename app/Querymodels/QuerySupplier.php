<?php
namespace App\Querymodels;
use DB;
class QuerySupplier{

	public function getSupplierLedger($supplier_id){
		$where = 'where purchases.supplier_id='.$supplier_id;
		if(isset($_GET['start_date']) && $_GET['start_date'] !='')
		{
			$start_date =  $_GET['start_date'];
			$end_date = $_GET['end_date'];
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = date("Y-m-d", strtotime($end_date));
			$where.= " && purchases.purchase_date>='".$start_date."' && purchases.purchase_date<='".$end_date."'";
		}
		return DB::select('select purchases.invoice_ref,purchases.supplier_id, purchases.purchase_date,sum(purchases.payable) payable, suppliers.name, pv_sum, pr_sum 
				from purchases inner join suppliers on suppliers.id=purchases.supplier_id 
				left join (select sum(paymentvouchers.payment) as pv_sum, paymentvouchers.invoice_ref as pv_invoice_ref from paymentvouchers group by paymentvouchers.invoice_ref) 
				sumofpv on purchases.invoice_ref=sumofpv.pv_invoice_ref left join (select sum(purchasereturns.return_price) as pr_sum, purchasereturns.invoice_ref as pr_invoice_ref from purchasereturns group by purchasereturns.invoice_ref) 
				sumofpr on purchases.invoice_ref=sumofpr.pr_invoice_ref 
				'.$where.' 
				group by purchases.invoice_ref');
	}
}