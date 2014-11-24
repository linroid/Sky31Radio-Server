<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DownloadOld extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'download-old';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '下载四季电台原有节目';

    /**
     * Create a new command instance.
     *
     * @return \DownloadOld
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
        foreach($xml->album as $album_node){
            $album_attributes = $album_node->attributes();
            /**
             * @var Album $album
             */
            $album = Album::whereName($album_attributes->name)->first();
            foreach($album_node->song as $song_node){
                $song_attributes = $song_node->attributes();

                $program = new Program();
                $program->user_id = 1;
                $program->title = $song_attributes->name;
                $program->author = null;
                $program->article = null;
                $album->programs()->save($program);

                $audio = new Audio();
                $audio->duration = $song_attributes->duration;
                $audio->path = $song_attributes->downloadSource;
                $audio->size = 0;
                $program->audio()->save($audio);
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
