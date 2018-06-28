<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Purchases extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchases';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'unit_price', 'unit_tax', 'tax_type', 'unit_price_with_tax', 'unit_count','unit', 'carriage_charges','load_charges', 'unit_purchase_price', 'selling_price', 'supplier_id', 'payable', 'paid_price', 'invoice_ref', 'purchase_date', 'remarks'];

    
    public function item(){
    	return $this->hasOne('App\Items', 'id', 'item_id');
    }
    public function supplier(){
    	return $this->hasOne('App\Suppliers', 'id', 'supplier_id');
    }
    public function saleItems(){
    	return $this->hasMany('App\Inventories', 'purchase_id', 'id')->where('status',2);
    }
    public function purchaseReturns(){
    	return $this->hasMany('App\Inventories', 'purchase_id', 'id')->where('status',3);
    }
}
