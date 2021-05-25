<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReduceQtyProductTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER reduceqtyproduct AFTER INSERT ON takes
        FOR EACH ROW
        BEGIN
            UPDATE `products`
            SET qty = qty - NEW.qty
            WHERE name = new.id_product;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared('DROP TRIGGER `reduceqtyproduct`');
    }
}
