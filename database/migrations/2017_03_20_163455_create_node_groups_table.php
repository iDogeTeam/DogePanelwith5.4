<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('node_groups', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('name');
		    $table->text('description');
		    $table->string('type');
		    $table->double('price')->default(1);
		    $table->string('method')->default('aes-256-cfb');
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
		Schema::dropIfExists('node_groups');
	}
}
