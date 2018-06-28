<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['item_name', 'description', 'item_number', 'brand', 'category', 'quantity_in_stock'];

}
