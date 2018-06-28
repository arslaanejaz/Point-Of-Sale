<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
    {
        DB::statement( 'CREATE VIEW inventory_stock AS select itm.item_name, purch.unit_purchase_price,purch.selling_price,purch.unit_price,purch.purchase_date, purch.id as purchase_id, purch.invoice_ref,purch.unit_count, sup.name as supplier, count(case when inv.status=2 then 1 end) as sold_ct, count(case when inv.status=3 then 1 end) as p_return_ct from purchases as purch inner join items as itm on purch.item_id=itm.id inner join inventories as inv on inv.purchase_id=purch.id inner join suppliers as sup on sup.id=purch.supplier_id  group by inv.purchase_id' );
    }

    public function down()
    {
        DB::statement( 'DROP VIEW inventory_stock' );
    }
}
