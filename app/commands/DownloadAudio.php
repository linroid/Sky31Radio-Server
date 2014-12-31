<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DownloadAudio extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'download:audio';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '下载音频文件.';

    /**
     * Create a new command instance.
     *
     * @return \DownloadAudio
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
		$audios = Audio::all();
        foreach($audios as $audio){
            $this->download('http://radio.sky31.com/'.$audio->path, 'uploads/'.$audio->path);
        }
	}
    private function download($url, $path){
        $this->line('-------------------------');
        $this->line('下载: '.$url);
        $this->line('mkdir: '.'public/'.dirname($path));
        File::makeDirectory('public/'.dirname($path) , 0777, true, true);

        // file handler
        $file = fopen('public/'.$path, 'w');
        // cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // set cURL options
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // set file handler option
        curl_setopt($ch, CURLOPT_FILE, $file);
        // execute cURL
        curl_exec($ch);
        // close cURL
        curl_close($ch);
        // close file
        fclose($file);
        $this->info("下载成功");
        $this->line('-------------------------');
        $this->line("\n\n");
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
