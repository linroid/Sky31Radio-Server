<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->string('password');
            /**
             * admin:管理员,anchor:主播,normal:普通用户
             */
            $table->enum('role', ['admin', 'anchor', 'normal']);
            $table->string('remember_token')->nullable();
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
        Schema::drop('users');
    }

}
