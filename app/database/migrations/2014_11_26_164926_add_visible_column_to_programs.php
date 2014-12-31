<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVisibleColumnToPrograms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programs', function(Blueprint $table)
		{
            $table->boolean('visible')->default(true);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programs', function(Blueprint $table)
		{
			$table->dropColumn('visible');
		});
	}

}
