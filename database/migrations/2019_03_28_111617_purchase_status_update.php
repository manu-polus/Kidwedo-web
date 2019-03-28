<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PurchaseStatusUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('purchases', function (Blueprint $table) {
            $table->string('purchase_status', 200)->after('purchase_type_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('purchase_status');
        });
    }
}
