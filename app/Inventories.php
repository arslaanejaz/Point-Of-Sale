<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventories extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'selling_price', 'supplier_id', 'purchase_id', 'transaction_id', 'return_id', 'user_id', 'status'];

public function item(){
    	return $this->hasOne('App\Items', 'id', 'item_id');
    }
    
public function purchase(){
    	return $this->hasOne('App\Purchases', 'id', 'purchase_id');
    }
}
