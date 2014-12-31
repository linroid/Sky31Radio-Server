<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * 节目
 * Class CreateProgramTable
 */
class CreateProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programs', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('album_id');
            //节目名称
            $table->string('title');
            //作者
            $table->string('author')->nullable();
            //节目附加文章
            $table->text('article')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('program');
	}

}
