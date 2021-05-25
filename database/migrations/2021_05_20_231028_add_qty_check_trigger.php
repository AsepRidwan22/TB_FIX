<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtyCheckTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER addqtycheck AFTER INSERT ON products
        FOR EACH ROW
            IF NEW.id != 0
                THEN
                    INSERT INTO `reports` (`id_product`, `name`, `qty`, `created_at`) VALUES (NEW.id, NEW.name, NEW.qty, NEW.created_at);
            END IF');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared('DROP TRIGGER `addqtycheck`');
    }
}
