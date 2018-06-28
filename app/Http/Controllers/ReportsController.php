<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Suppliers;
use App\Customers;
use App\Querymodels\QueryReports;
use App\Users;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use App\Querymodels\QueryTransact;
//use Auth;

class ReportsController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    return view('reports.index');
	}
   public function salesReport(){
    //$name = Request::input('start_date');
   	   $nodata = false;
       $obj = new QueryReports();
       $transaction = $obj->getSalesReport();
       if(!$transaction)$nodata = true;
   return view('reports.sales_report',compact('transaction', 'nodata'));
   }
   public function purchaseReturnReport(){
   	$nodata = false;
   	$obj = new QueryReports();
   	$transaction = $obj->getPurchaseReturnReport();
   	if(!$transaction)$nodata = true;
   	return view('reports.purchase_return',compact('transaction', 'nodata'));
   }
   public function saleReturnReport(){
   	$nodata = false;
   	$obj = new QueryReports();
   	$transaction = $obj->getSaleReturnReport();
   	if(!$transaction)$nodata = true;
   	return view('reports.sale_return',compact('transaction', 'nodata'));
   }
   public function profitLossReport(){
   	$nodata = false;
   	$obj = new QueryReports();
   	$transaction = $obj->getProfitLossReport();
   	if(!$transaction)$nodata = true;
   	return view('reports.profit_loss',compact('transaction', 'nodata'));
   }
    public function supplierSalesReport(){
       $nodata = false;
       $transact = new QueryTransact();
       $suppliers  = $transact->getSuppliers();
       $queryReports = new QueryReports();
       $transaction = $queryReports->getSalesReportSupplier();
       if(!$transaction)$nodata = true;
   return view('reports.supplier_report',compact('transaction', 'nodata', 'suppliers'));
    }










}
