<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('ss_user_services', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->string('type'); // anyconnect or shadowsocks
	    	$table->string('password');
		    $table->integet('port')->nullable();
		    $table->string('method')->nullable();
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
		Schema::dropIfExists('ss_user_services');
	}

}
