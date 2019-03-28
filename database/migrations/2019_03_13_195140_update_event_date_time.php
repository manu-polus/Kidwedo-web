<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('event_dates', function($table)
        {
            $table->time('from_time')->change();
            $table->time('to_time')->change();
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
        Schema::table('event_dates', function($table)
        {
            $table->string('from_time')->change();
            $table->string('to_time')->change();
        });
    }
}
