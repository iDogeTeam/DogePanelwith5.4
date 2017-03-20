<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('ss_node_log', function (Blueprint $table) {
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
		Schema::dropIfExists('ss_node_log');
	}
}
