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
	    Schema::create('user_services', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('group_id'); // NodeGroup
		    $table->string('type'); // anyconnect or shadowsocks
		    $table->string('status')->default('enable'); // enable or disable
	    	$table->string('password');
		    $table->integet('port')->nullable();
		    $table->string('method')->nullable();
		    $table->integer('total_cost')->default(0);
		    $table->json('total_amount'); // 记录服务节点情况
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
		Schema::dropIfExists('user_services');
	}

}
