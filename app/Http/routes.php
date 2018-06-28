<?php

use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//router commet for testing

//patern
$router->pattern('id', '[0-9]+');
$router->pattern('qty', '[0-9]+');

//login
Route::post('login', 'LoginUserController@login');

Route::get('auth/login', 'LoginUserController@index');
Route::get('/', 'LoginUserController@index');

Route::get('auth/logout', function (){
	Auth::logout();
	return redirect('/');
});

//checkeditor auth
Route::group(array('middleware' => 'roleadmin'), function (){


//Users controller
Route::resource('users', 'UsersController');
Route::get('auth/register', 'UsersController@create');

//Supplier controller
Route::resource('supplier', 'SupplierController');
Route::get('supplier/ledger/{id}', 'SupplierController@showLedger');

//Supplier controller
Route::resource('customer', 'CustomerController'); 

//Brand controller
Route::resource('brand', 'BrandController');

//Category controller
Route::resource('category', 'CategoryController');

//Item controller
Route::resource('item', 'ItemController');

//purchase controller
Route::resource('purchase', 'PurchaseController');

//paymentvoucher controller
Route::resource('paymentvoucher', 'PaymentvoucherController');
Route::get('paymentvoucher/getvoucher/{param}', 'PaymentvoucherController@getVoucher');

//Customer controller
Route::resource('inventory', 'InventoryController');




	});
	
	Route::group(array('middleware' => 'roleclerk'), function (){
		
	//Transaction controller
	Route::get('transaction', 'TransactionController@index');
	Route::get('transaction/trasnactionprint/{id}', 'TransactionController@trasnactionPrint');
	Route::get('transaction/trasnactionlist', 'TransactionController@trasnactionList');
	Route::post('transaction/process', 'TransactionController@process');
	Route::get('transaction/getbcode/{param}', 'TransactionController@getbcode');
	Route::get('transaction/getItemPrice/{param}', 'TransactionController@getItemPrice');
	Route::post('transaction/store', 'TransactionController@store');
	Route::delete('transaction/deleteitem/{id}', 'TransactionController@deleteitem');
	Route::post('transaction/changeQuantity', 'TransactionController@changeQuantity');
	
	//purchasereturn controller
	Route::resource('purchasereturn', 'PurchasereturnController');
	Route::get('purchasereturn/returnitems/{id}/{qty}', 'PurchasereturnController@returnItems');
	//Route::post('purchasereturn/savePrint', 'PurchasereturnController@savePrint');
	
	//salereturn controller
	Route::resource('salereturn', 'SalereturnController');
	Route::post('salereturn/savePrint', 'SalereturnController@savePrint');
	
	});
	
	
		Route::group(array('middleware' => 'rolereportview'), function (){
			//Home controller
			Route::get('home', 'HomeController@index');
			
			//Reports controller
			Route::get('reports','ReportsController@index');
			Route::get('reports/sales_report', 'ReportsController@salesReport');
			Route::get('reports/sales_report_supplier', 'ReportsController@supplierSalesReport');
			Route::get('reports/profit_loss_report', 'ReportsController@profitLossReport');
			Route::get('reports/purchase_return_report', 'ReportsController@purchaseReturnReport');
			Route::get('reports/sale_return_report', 'ReportsController@saleReturnReport');
		});