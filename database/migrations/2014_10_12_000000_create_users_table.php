<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user'); // user or admin
	        $table->integer('active_time')->nullable();
	        $table->integer('group_id')->nullable(); // Divide Users
	        $table->ipAddress('register_ip');
	        $table->integer('ref_by')->nullable();
	        $table->string('status')->default('pending'); // enable or disable or pending
	        $table->integer('traffic_enable')->default(1);
	        $table->text('note')->nullable();

	        // Level
	        $table->BigInteger('exp')->default(1);

	        //  Service related
	        $table->bigInteger('coin')->default(env('INIT_COIN',1000));
	        $table->integer('quota')->default(env('MIN_COIN',100));

            // Communication tools related
	        $table->string('telegram_token')->nullable();
            $table->integer('telegram_id')->nullable();

            $table->rememberToken();
	        // Timestamps
            $table->integer('created_at');
            $table->integer('updated_at');
	        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
