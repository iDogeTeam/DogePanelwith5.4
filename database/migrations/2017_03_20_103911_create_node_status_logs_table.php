<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('node_status_logs', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('node_id');
		    $table->float('uptime');
		    $table->string('load');
		    $table->string('online_user');
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
		Schema::dropIfExists('node_status_logs');
	}
}
