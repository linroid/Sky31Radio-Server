<?php


class AlbumTableSeeder extends Seeder {

	public function run()
	{
        Album::create(['name'=>'青春祭',     'type'=>'season']);
        Album::create(['name'=>'春·绘声绘影', 'type'=>'season']);
        Album::create(['name'=>'夏·爱的发声', 'type'=>'season']);
        Album::create(['name'=>'秋·小情小调', 'type'=>'season']);
        Album::create(['name'=>'冬·你说我说', 'type'=>'season']);
	}

}