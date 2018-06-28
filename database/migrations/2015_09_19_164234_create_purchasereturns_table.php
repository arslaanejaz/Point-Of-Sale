<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasereturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('purchasereturns', function(Blueprint $table)
            {
            $table->increments('id');
            $table->integer('purchase_id');
            $table->string('invoice_ref', 32);
            $table->string('reason', 250);
            $table->integer('return_item_count');
            $table->decimal('return_price', 8,2);
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
        Schema::drop('purchasereturns');
    }
}
