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
	        $table->string('registration_date');
	        $table->integer('level'); // Divide Users
	        $table->ipAddress('register_ip');
	        $table->integer('ref_by')->nullable();
	        $table->string('status')->default('pending'); // enable or disable or pending
	        $table->text('note')->nullable();

	        //  Service related
	        $table->bigInteger('coin')->default(env('INIT_COIN',1000));
	        $table->integer('quota');

            // Communication tools related
	        $table->string('telegram_token')->nullable();
            $table->integer('telegram_id')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
