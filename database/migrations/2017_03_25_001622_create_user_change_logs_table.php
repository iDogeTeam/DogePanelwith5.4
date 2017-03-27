<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('user_change_logs', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('source_id');
		    $table->integer('source_type'); // Items, Checkin, etc
		    $table->Integer('coin');
		    $table->text('note')->nullable();  // Description
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
		Schema::dropIfExists('user_change_logs');
	}
}
