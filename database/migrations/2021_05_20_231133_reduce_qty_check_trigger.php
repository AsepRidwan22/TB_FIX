<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReduceQtyCheckTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER reduceqtycheck AFTER INSERT ON takes
        FOR EACH ROW
            IF NEW.id != 0
                THEN
                    INSERT INTO `reportouts` (`id_product`, `qty`, `created_at`) VALUES (NEW.id_product, NEW.qty, NEW.created_at);
            END IF');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared('DROP TRIGGER `reduceqtycheck`');
    }
}
