<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurchasesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('user_id', 10, 0);
            $table->decimal('event_plan_id', 10, 0);
            $table->decimal('purchase_type_code', 3, 0);
            $table->timestamps();
        });

        Schema::create('purchase_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 200);
            $table->timestamps();
        });

        Schema::table('payments', function(Blueprint $table)
        {
            $table->decimal('plan_id', 10, 0)->after('payer_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');

        Schema::dropIfExists('purchase_type');

        Schema::table('payments', function(Blueprint $table) {
            $table->dropColumn('plan_id');
        });
    }
}
