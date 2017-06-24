<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('traffic_logs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('service_id');
			$table->integer('node_id');
			$table->bigInteger('upload');
			$table->bigInteger('download');
			$table->double('upload_price')->default(1);
			$table->double('download_price')->default(1); // Prevent to much search from node model and calculated caught from model itself
			$table->integer('counted')->default(0); // set to 1 when the traffic is transferred into coins and conducted from user's account
			$table->double('coin')->nullable();
			$table->integer('created_at');
			$table->integer('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('traffic_logs');
	}
}
