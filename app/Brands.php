<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'brands';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

}
