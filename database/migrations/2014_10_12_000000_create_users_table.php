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
	        $table->integer('ref_by')->nullable();
	        $table->string('status')->default('pending'); // enable or disable or pending
	        $table->text('note')->nullable();
            // Traffic related
	        $table->bigInteger('total_traffic');
	        $table->bigInteger('traffic_enable');
            $table->bigInteger('upload');
            $table->bigInteger('download');
            $table->string('ss_passwd');
            $table->integet('ss_port');
            $table->string('method');
            // Communication related
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
