<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_return', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id');
            $table->integer('trans_purchase_id');
            $table->boolean('return_type');
            /*
            $table->string('reason');
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->decimal('return_price', 8, 2);
            */
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
       Schema::drop('transaction_return');
    }
}
