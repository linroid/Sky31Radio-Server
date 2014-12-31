<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddThumbnailToPrograms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programs', function(Blueprint $table)
		{
            $table->string('thumbnail');

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
            $table->string('thumbnail');
        });
	}

}
