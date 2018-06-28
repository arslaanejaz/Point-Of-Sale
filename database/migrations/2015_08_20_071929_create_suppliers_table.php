<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('suppliers', function(Blueprint $table)
            {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('account_id', 36);
            $table->string('cnic', 16);
            $table->string('city', 32);
            $table->string('address', 100);
            $table->string('phone', 16);
            $table->string('mobile', 16);
            $table->string('email', 50);
            $table->string('contact_person', 32);
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
        Schema::drop('suppliers');
    }
}
