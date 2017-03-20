<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrafficChangeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ss_user_traffic_change_log', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->double('traffic');
			$table->string('type'); // GiftCode, Checkin, etc
			$table->text('note')->nullable();  // Description on a specific traffic
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
		Schema::dropIfExists('ss_user_traffic_change_log');
	}
}
