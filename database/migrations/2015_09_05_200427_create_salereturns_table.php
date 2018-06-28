<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalereturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('salereturns', function(Blueprint $table)
            {
            $table->increments('id');
            $table->string('reason');
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->decimal('return_price', 8, 2);
            $table->text('sale_return_ids');
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
        Schema::drop('salereturns');
    }
}
