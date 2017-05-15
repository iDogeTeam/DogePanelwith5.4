<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('sp_logs', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->string('action');
		    $table->string('description');
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
		Schema::dropIfExists('sp_logs');
	}
}
