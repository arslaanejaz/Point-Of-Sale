<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('transaction', function(Blueprint $table)
            {
            $table->increments('id');
            //$table->tinyInteger('discount_type',1);
            //$table->decimal('discount_cent',5,2);
            //$table->decimal('discount_amount',8,2);
            $table->decimal('bill',8,2);
            $table->decimal('pay',8,2);
            $table->decimal('change',8,2);
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->timestamps();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction');
    }
}
