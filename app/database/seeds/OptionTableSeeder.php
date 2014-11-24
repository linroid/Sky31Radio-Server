<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class OptionTableSeeder extends Seeder {

	public function run()
	{
        Option::create(['key'=>'site_title', 'value'=>'四季电台']);

	}

}