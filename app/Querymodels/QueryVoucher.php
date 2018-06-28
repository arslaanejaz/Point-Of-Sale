<?php
namespace App\Querymodels;
use DB;
class QueryVoucher{
public function getVouchers(){
	$d = DB::select('select payables.invoice_ref,payables.payable_sum, pv_sum, pr_sum from payables left join (select sum(paymentvouchers.payment) as pv_sum, paymentvouchers.invoice_ref as pv_invoice_ref from paymentvouchers group by paymentvouchers.invoice_ref) sumofpv on payables.invoice_ref=sumofpv.pv_invoice_ref left join (select sum(purchasereturns.return_price) as pr_sum, purchasereturns.invoice_ref as pr_invoice_ref from purchasereturns group by purchasereturns.invoice_ref) sumofpr on payables.invoice_ref=sumofpr.pr_invoice_ref');
	return $d;

}	

public function getInvoicePayments($invoice_ref){
	return DB::table('paymentvouchers')
	->where('invoice_ref', $invoice_ref)
	->groupBy('invoice_ref')
	->sum('payment');
}

public function getReturnPayments($invoice_ref){
	return DB::table('purchasereturns')
	->where('invoice_ref', $invoice_ref)
	->groupBy('invoice_ref')
	->sum('return_price');
}


}