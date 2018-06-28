<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentvouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('paymentvouchers', function(Blueprint $table)
            {
            $table->increments('id');
            $table->string('invoice_ref', 32);
            $table->decimal('payment', 8, 2);
            $table->boolean('type');
            $table->string('bank_name', 32);
            $table->string('cheque_no', 10);
            $table->date('payment_date');
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
        Schema::drop('paymentvouchers');
    }
}
