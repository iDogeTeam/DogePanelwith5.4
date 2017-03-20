<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTrafficLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('ss_user_used_traffic_log', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('upload');
		    $table->integer('download');
		    $table->integer('node_id');
		    $table->integer('rate_group')->default(0);
		    $table->string('traffic');
		    $table->timestamps();
	    });
    }

	/**
	 * Reverse the migrations.
	 *：
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ss_user_used_traffic_log');
	}
}
