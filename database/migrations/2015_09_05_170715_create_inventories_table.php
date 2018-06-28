<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('inventories', function(Blueprint $table)
            {
            $table->increments('id');
            $table->integer('item_id');
            $table->decimal('selling_price', 8, 2);
            $table->integer('supplier_id');
            $table->integer('purchase_id');
            $table->integer('transaction_id');
            $table->integer('return_id');
            $table->integer('user_id');
            $table->tinyInteger('status');
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
        Schema::drop('inventories');
    }
}
