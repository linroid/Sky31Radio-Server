<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLuckyUserInfoToVisitors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visitors', function(Blueprint $table)
		{
	        $table->string('name');
	        $table->string('qq');
	        $table->string('phone');
	        $table->string('info');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visitors', function(Blueprint $table)
		{
			$table->dropColumn(['name', 'qq', 'phone', 'info']);
		});
	}

}
