<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Paymentvouchers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Querymodels\QueryTransact;
use App\Querymodels\QueryVoucher;

class PaymentvoucherController extends Controller
{
	private $payment_type = array('0'=>'Cash', '1'=>'Cheque');

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$qv = new QueryVoucher();
		$paymentvouchers = $qv->getVouchers();
		
		//$paymentvouchers = Paymentvouchers::latest()->get();
		return view('paymentvoucher.index', compact('paymentvouchers'));
	}
	
	public function getVoucher($voucherRef)
	{
	
		$paymentvoucher = Paymentvouchers::where('invoice_ref',$voucherRef)->get();
		$payment_type = $this->payment_type;
		return view('paymentvoucher.voucher', compact('paymentvoucher', 'payment_type'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$obj = new QueryTransact();
		$voucher = new QueryVoucher();
		$invoice_ref = $obj->getVoucherRef();
		$type = $this->payment_type;
		
		$balance = ['paidPrice'=>0, 'payable'=>0, 'itemReturnPrice'=>0];
		if(isset($_GET['id']) && $_GET['id']!=''){
			$id = $_GET['id'];

			$balance['payable'] = $obj->getPayablePrice($id);
			
			$balance['paidPrice'] = $voucher->getInvoicePayments($id);
			
			$balance['itemReturnPrice'] = $voucher->getReturnPayments($id);
			
		}
		
		return view('paymentvoucher.create', compact('invoice_ref', 'type', 'balance'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['invoice_ref' => 'required', 'payment' => 'required|numeric']); // Uncomment and modify if needed.
		Paymentvouchers::create($request->all());
		return redirect('paymentvoucher/create?id='.$request->invoice_ref);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$paymentvoucher = Paymentvouchers::findOrFail($id);
		return view('paymentvoucher.show', compact('paymentvoucher'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$obj = new QueryTransact();
		$invoice_ref = $obj->getVoucherRef();
		$type = $this->payment_type;
		$paymentvoucher = Paymentvouchers::findOrFail($id);
		return view('paymentvoucher.edit', compact('paymentvoucher', 'invoice_ref', 'type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$this->validate($request, ['invoice_ref' => 'required']); // Uncomment and modify if needed.
		$paymentvoucher = Paymentvouchers::findOrFail($id);
		$paymentvoucher->update($request->all());
		return redirect('paymentvoucher');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Paymentvouchers::destroy($id);
		return redirect('paymentvoucher');
	}

}
