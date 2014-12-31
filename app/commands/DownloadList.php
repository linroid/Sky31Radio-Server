<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DownloadList extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'download:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '下载四季电台原有节目';

    /**
     * Create a new command instance.
     *
     * @return \DownloadList
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $response = \Httpful\Request::get('http://radio.sky31.com/player/xml/mp3_player.xml')
            ->expectsXml()
            ->send();
        /**
         * @var SimpleXMLElement $xml;
         */
        $xml = $response->body;
        $arr = array();
        foreach($xml->album as $album_node) {
            array_push($arr, $album_node);
        }
//        foreach($xml->album as $album_node){
        for( $i=count($arr)-1; $i>=0; $i--){
            $album_node = $arr[$i];
            $album_attributes = $album_node->attributes();
            /**
             * @var Album $album
             */
            $album = Album::whereName($album_attributes->name)->first();
            $song_count = $album_node->count();
//            foreach($album_node->song as $song_node){
            for($song_index=0; $song_index<$song_count; $song_index++){
                $song_node = $album_node->song[$song_index];
                if(empty($song_node) ||empty($album)){
                    continue;
                }
                $song_attributes = $song_node->attributes();
                $program = new Program();
                $program->user_id = 1;
                $program->title = $song_attributes->name;
                $program->author = null;
                $program->article = null;
                $program->album_id = $album->id;
                $program->save();

                $audio = new Audio();
                $audio->duration = $song_attributes->duration;
                $audio->path = $song_attributes->downloadSource;
                $audio->size = 0;
                $audio->program_id = $program->id;
                $audio->save();
            }
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
