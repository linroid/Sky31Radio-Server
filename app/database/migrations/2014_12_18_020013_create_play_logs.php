<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayLogs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('play_logs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('program_id');
            $table->string('ip');
			$table->timestamps();
            $table->foreign('program_id')->references('id')->on('programs');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('play_logs');
	}

}
