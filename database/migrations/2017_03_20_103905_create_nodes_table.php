<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nodes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name'); // node name
			$table->string('type'); // service type
			$table->string('token');
			$table->integer('group_id');
			$table->string('domain_name')->nullable(); // domain
			$table->ipAddress('ip_address');
			$table->string('method')->nullable(); // Null Means allow any.
			$table->text('note')->nullable();
			$table->double('upload_price')->default(1);
			$table->double('download_price')->default(1);
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
		Schema::dropIfExists('nodes');
	}
}
