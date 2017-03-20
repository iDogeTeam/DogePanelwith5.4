<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeInfosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ss_node', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name'); // node name
			$table->string('type'); // extra section for further development
			$table->integer('group_id');
			$table->string('domain_name')->nullable(); // domain
			$table->string('ip_address');
			$table->string('method')->default(NULL);
			$table->string('custom_method')->nullable(); // Allow non-custsom
			$table->text('info')->nullable();
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
		Schema::dropIfExists('ss_node');
	}
}
