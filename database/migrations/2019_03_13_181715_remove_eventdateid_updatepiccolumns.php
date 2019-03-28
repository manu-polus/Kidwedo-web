<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEventdateidUpdatepiccolumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealers', function($table) {
            $table->renameColumn('logo_picture', 'logo_pic_filename');
            $table->renameColumn('main_picture', 'main_pic_filename');
        });
        Schema::table('events', function($table) {
            $table->renameColumn('picture', 'pic_filename');
            $table->dropColumn('event_date_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dealers', function($table) {
            $table->renameColumn('logo_pic_filename', 'logo_picture');
            $table->renameColumn('main_pic_filename', 'main_picture');
        });
        Schema::table('events', function($table) {
            $table->renameColumn('pic_filename', 'picture');
            $table->decimal('event_date_id', 10, 0)->after('category_id');
        });
    }
}
