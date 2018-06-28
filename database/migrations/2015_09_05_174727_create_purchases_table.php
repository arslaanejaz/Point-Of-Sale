<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('purchases', function(Blueprint $table)
            {
            $table->increments('id');
            $table->integer('item_id');
            $table->decimal('unit_price', 8, 2);
            $table->decimal('unit_tax', 8, 2);
            $table->boolean('tax_type');
            $table->decimal('unit_price_with_tax', 8, 2);
            $table->integer('unit_count');
            $table->tinyInteger('unit');
            $table->decimal('carriage_charges', 8, 2);
            $table->decimal('load_charges', 8, 2);
            $table->decimal('unit_purchase_price', 8, 2);
            $table->decimal('selling_price', 8, 2);
            $table->integer('supplier_id');
            $table->decimal('payable', 8, 2);
            $table->decimal('paid_price', 8, 2);
            $table->string('invoice_ref', 32);
            $table->date('purchase_date');
            $table->string('remarks',255);
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
        Schema::drop('purchases');
    }
}
