<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'discounts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['discount_type', 'discount_cent', 'discount_amount', 'transaction_id'];

}