<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveQqAndAddSchoolToVisitors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visitors', function(Blueprint $table)
		{
            $table->dropColumn('qq');
            $table->string('school')->default('湘潭大学');
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
			$table->dropColumn('school');
            $table->string('qq');
		});
	}

}
