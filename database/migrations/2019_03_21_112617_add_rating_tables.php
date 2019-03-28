<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('user_id', 10, 0);
            $table->decimal('dealer_id', 10, 0);
            $table->decimal('rating', 3, 0);
            $table->text('comment');
            $table->timestamps();
        });

        Schema::create('event_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('user_id', 10, 0);
            $table->decimal('event_id', 10, 0);
            $table->decimal('rating', 3, 0);
            $table->text('comment');
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
        Schema::dropIfExists('provider_ratings');
        
        Schema::dropIfExists('event_ratings');
    }
}
