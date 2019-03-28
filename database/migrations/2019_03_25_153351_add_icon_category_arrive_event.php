<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconCategoryArriveEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->text('icon_file_name')->after('description');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('arrive_before',200)->after('is_caregiver_needed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('icon_file_name');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('arrive_before');
        });
    }
}
