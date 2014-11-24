<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
        $user = new User();
        $user->nickname = '你是个好人啦';
        $user->email = 'linroid@gmail.com';
        $user->role = 'admin';
        $user->password = Hash::make('zhang8');
        $user->save();
	}

}