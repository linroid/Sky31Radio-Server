<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContributionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contributions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('contact');
            $table->unsignedInteger('program_id');
            $table->timestamp('passed_at')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on("programs")->onDelete('cascade')->onUpdate('cascade');;
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contributions');
	}

}
