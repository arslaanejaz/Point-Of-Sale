<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentvouchers extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paymentvouchers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_ref', 'payment', 'type', 'bank_name', 'cheque_no', 'payment_date'];

}
