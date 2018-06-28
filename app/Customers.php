<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'account_id', 'cnic', 'city', 'address', 'phone', 'mobile', 'email', 'contact_person'];

}
