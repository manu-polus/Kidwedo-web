<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kidwedo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) 
            {
                $table->string('last_name',50)->nullable()->after('name');
                $table->string('full_name',100)->nullable()->after('last_name');
                $table->string('address',600)->nullable()->after('full_name');
                $table->string('mobile_number',20)->after('email');
                $table->decimal('status_id', 3, 0)->after('password');
                $table->decimal('available_credits', 10, 0)->nullable()->after('status_id');
                $table->decimal('plan_id', 3, 0)->nullable()->after('available_credits');
            });

            Schema::create('user_roles', function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('user_id', 10, 0);
                $table->decimal('user_role_type_id', 3, 0);
                $table->timestamps();
            });

            Schema::create('status', function (Blueprint $table) {
                $table->increments('id');
                $table->string('description',200);
                $table->timestamps();
            });

            Schema::create('user_role_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('description',200);
                $table->timestamps();
            });

            Schema::create('purchases', function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('user_id', 10, 0);
                $table->decimal('event_id', 10, 0);
                $table->timestamps();
            });

            Schema::create('dealers', function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('user_id', 10, 0);
                $table->string('business_name',600);
                $table->string('zipcode',12);
                $table->longText('description');
                $table->string('website',500)->nullable();
                $table->string('location_longitude',50)->nullable();
                $table->string('location_latitude',50)->nullable();
                $table->longText('logo_picture')->nullable();
                $table->longText('main_picture')->nullable();
                $table->longText('editors_tip')->nullable();
                $table->timestamps();
            });

            Schema::create('payments', function (Blueprint $table) {
                $table->increments('id');
                $table->text('transaction_id');
                $table->text('token');
                $table->string('payer_id');
                $table->string('payer_name');
                $table->string('payer_email');
                $table->string('gateway');
                $table->string('payer_user_id');
                $table->string('status');
                $table->integer('amount');
                $table->string('currency');
                $table->longText('response');
                $table->timestamps();
            });

            Schema::create('events', function (Blueprint $table) {
                $table->increments('id');
                $table->string('event_name',500);
                $table->decimal('dealer_id', 10, 0);
                $table->decimal('preferred_age_id', 3, 0);
                $table->decimal('category_id', 3, 0);
                $table->decimal('event_date_id', 10, 0);
                $table->longText('description');
                $table->longText('additional_description')->nullable();
                $table->string('city',100);
                $table->decimal('credit', 12, 0);
                $table->string('event_status',30);
                $table->string('cancellation_policy', 200);
                $table->string('is_caregiver_needed',1);
                $table->string('event_duration',90);
                $table->string('location_longitude',50)->nullable();
                $table->string('location_latitude',50)->nullable();
                $table->string('picture',500)->nullable();
                $table->timestamps();
            });
    
            Schema::create('event_dates', function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('event_id', 10, 0);
                $table->date('date');
                $table->string('from_time', 50);
                $table->string('to_time', 50);
                $table->decimal('total_seats', 12, 0);
                $table->decimal('seat_remaining', 12, 0);
                $table->timestamps();
            });

            Schema::create('category', function (Blueprint $table) {
                $table->increments('id');
                $table->string('description',200);
                $table->timestamps();
            });
    
            Schema::create('preferred_ages', function (Blueprint $table) {
                $table->increments('id');
                $table->string('description',200);
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
        Schema::dropIfExists('status');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('user_role_types');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('dealers');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event-dates');
        Schema::dropIfExists('category');
        Schema::dropIfExists('preferred-ages');

        Schema::table('users', function($table) {
            $table->dropColumn('last_name');
            $table->dropColumn('full_name');
            $table->dropColumn('address');
            $table->dropColumn('mobile_number');
            $table->dropColumn('status_id');
            $table->dropColumn('available_credits');
            $table->dropColumn('plan_id')->nullable();
        });
    }
}
