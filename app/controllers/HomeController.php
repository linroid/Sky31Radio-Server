<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('index');
	}
    public function getContribute(){
        $albums = [];
        $albums['season'] = Album::seasons()->get()->toArray();
        $albums['activity'] = Album::activities()->get()->toArray();

        return View::make('contribute.create')
            ->with('albums', $albums);
    }
    public function postContribute(){
        $data = Input::all();
        $rules = array(
            'title' => 'required',
            'contact' => 'required',
            'author' => 'required',
            'album_id'=>'required|exists:albums,id',
            'audio' => 'mimes:mpga|max:2048000',//20M
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
        );
        $message = array(
            'title.required'    => '标题必须!',
            'contact.required'    => '请填写联系方式!',
            'author.required'    => '请填写您的姓名',
            'album_id.required' => '请选择所属分类',
            'album_id.exists'   => '分类不存在',
            'audio.mimes'       => '请上传正确的音频文件',
            'audio.max'         => '音频文件大小应小于 :maxkb',
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $message);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $program = new Program($data);
        $program->user_id = Auth::id();

        if(Input::hasFile('cover')){
            /**
             * @var UploadedFile $cover_file
             */
            $cover_file = $data['cover'];

            $cover_path = 'uploads/cover/'.date('Y/m/d/',time());
            $file_path = 'public/'.$cover_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
            $cover_file->move($file_path, $filename);
            $program->cover = $cover_path.$filename;
        }
        $program->visible = 0;
        $program->save();

        if(Input::hasFile('audio')){
            /**
             * @var UploadedFile $audio_file
             */
            $audio_file = $data['audio'];

            $audio_path = 'uploads/audio/'.date('Y/m/d/',time());
            $file_path = 'public/'.$audio_path;
            if(!File::exists($file_path)){
                File::makeDirectory($file_path, 0777, true, true);
            }
            $filename = str_random(5).'_'.$audio_file->getClientOriginalName();
            $file = $audio_file->move($file_path, $filename);

            $audio = new Audio();
            $audio->size = $audio_file->getSize();
            $audio->path = $audio_path.$filename;
            $audio->duration;
            $program->audio()->save($audio);
        }

        $contribution = new Contribution();
        $contribution->contact = $data['contact'];
        $contribution->program_id = $program->id;
        $contribution->save();

        return Redirect::back()
            ->withFlashMessage('投稿成功,等待主编审核');
    }

}
