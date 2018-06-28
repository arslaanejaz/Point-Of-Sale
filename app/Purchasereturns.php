<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasereturns extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchasereturns';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_ref','reason', 'return_item_count', 'return_price', 'purchase_id'];

}
