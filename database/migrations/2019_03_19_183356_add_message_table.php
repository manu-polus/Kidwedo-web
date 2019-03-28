<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('from_user_id', 10, 0);
            $table->decimal('to_user_id', 10, 0);
            $table->longText('subject');
            $table->longText('message');
            $table->decimal('parent_id', 10, 0);
            $table->string('IsReadMessage', 1);
            $table->string('IsUserDeleted', 1);
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
        Schema::dropIfExists('messages');
    }
}
