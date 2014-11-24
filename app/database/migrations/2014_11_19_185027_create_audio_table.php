<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * 节目的音频文件
 * Class CreateAudiosTable
 */
class CreateAudioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audio', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('program_id');
            //路径
            $table->string('path');
            //文件大小，单位字节
            $table->unsignedBigInteger('size');
            //播放时长
            $table->string('duration');
			$table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voice');
	}

}
