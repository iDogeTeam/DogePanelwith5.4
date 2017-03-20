<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChangeLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('ss_user_traffic_total_log', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->bigInteger('total_traffic');
		    $table->string('giftcode_traffic');
		    $table->integer('giftcode_times'); // Number of used giftcode
		    $table->string('checkin_traffic');
		    $table->integer('checkin_times'); // Number of checkin time.
		    $table->timestamps();
	    });

	    // Note: This table will only be updated
	    // It can add when necessary XD
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ss_user_traffic_total_log');
	}
}
