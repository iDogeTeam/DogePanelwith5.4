<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('type'); // inviteCode, giftCode
			$table->integer('coin')->nullable();
			$table->string('token');
			$table->integer('used_times_limit')->default(1);
			$table->integer('group_limit')->nullable();
			$table->string('started_at')->nullable();
			$table->string('ended_at')->nullable();
			$table->string('note')->nullable();
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
		Schema::dropIfExists('items');
	}
}
