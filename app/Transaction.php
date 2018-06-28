<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['bill', 'pay', 'change', 'user_id', 'customer_id'];
    
    public function items(){
    	return $this->hasOne('App\Items', 'id', 'item_id');
    }
    public function discount(){
    	return $this->hasOne('App\Discounts', 'transaction_id', 'id');
    }
    public function user(){
    	return $this->hasOne('App\Users', 'id', 'user_id');
    }
    public function customer(){
    	return $this->hasOne('App\Customers', 'id', 'customer_id');
    }

}
