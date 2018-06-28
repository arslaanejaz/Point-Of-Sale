<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Salereturns extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salereturns';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['reason', 'customer_id', 'user_id', 'return_price', 'sale_return_ids'];

}
