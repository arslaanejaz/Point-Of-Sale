<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionReturn extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_return';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['inventory_id', 'trans_purchase_id', 'return_type'];
}
