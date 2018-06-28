<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('items', function(Blueprint $table)
            {
            $table->increments('id');
            $table->string('item_name', 32);
            $table->string('description');
            $table->string('item_number', 14);
            $table->integer('brand');
            $table->integer('category');
            $table->integer('quantity_in_stock');
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
        Schema::drop('items');
    }
}
