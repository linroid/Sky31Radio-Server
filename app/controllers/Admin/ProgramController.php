<?php
namespace Admin;

use Album;
use App;
use Audio;
use Auth;
use File;
use Input;
use Program;
use Redirect;
use Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use View;

class ProgramController extends BaseAdmin {

	/**
	 * Display a listing of the resource.
	 * GET /program
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /program/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $albums = [];
        $albums['season'] = Album::seasons()->get()->toArray();
        $albums['activity'] = Album::activities()->get()->toArray();

		return $this->view('program.create')
            ->with('albums', $albums);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /program
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
        $rules = array(
            'title' => 'required',
            'album_id'=>'required|exists:albums,id',
            'user_id'=>'required|exists:users,id',
            'audio' => 'mimes:mpga|max:2048000',//20M
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
            'background' => 'mimes:jpeg,bmp,png|max:4096',//4M
        );
        $message = array(
            'title.required'    => '标题必须!',
            'album_id.required' => '请选择所属分类',
            'album_id.exists'   => '分类不存在',
            'audio.mimes'       => '请上传正确的音频文件',
            'audio.max'         => '音频文件大小应小于 :maxkb',
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb',
            'background.mimes'  => '允许上传的背景图格式::mimes',
            'background.max'    => '背景图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $message);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $program = new Program($data);
//        $program->user_id = empty($data['user_id']) ? Auth::id() : $data['user_id'];

        if(Input::hasFile('cover')){
//            /**
//             * @var UploadedFile $cover_file
//             */
//            $cover_file = $data['cover'];
//
//            $cover_path = 'uploads/cover/'.date('Y/m/d/',time());
//            $file_path = 'public/'.$cover_path;
//            if(!File::exists($file_path)){
//                File::makeDirectory($file_path, 0777, true, true);
//            }
//            $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
//            $cover_file->move($file_path, $filename);
//            $program->cover = $cover_path.$filename;
            $program->cover = $this->savePicture('cover');
        }
        if(Input::hasFile('cover')){
//            /**
//             * @var UploadedFile $cover_file
//             */
//            $cover_file = $data['thumbnail'];
//
//            $thumbnail_path = 'uploads/thumbnail/'.date('Y/m/d/',time());
//            $file_path = 'public/'.$thumbnail_path;
//            if(!File::exists($file_path)){
//                File::makeDirectory($file_path, 0777, true, true);
//            }
//            $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
//            $cover_file->move($file_path, $filename);
//            $program->cover = $thumbnail_path.$filename;
            $program->thumbnail = $this->savePicture('thumbnail');
        }
        if(Input::hasFile('background')){
            $program->background = $this->savePicture('background');
        }
        $program->save();

        if(Input::hasFile('audio')){
//            /**
//             * @var UploadedFile $audio_file
//             */
//            $audio_file = $data['audio'];
//
//            $audio_path = 'uploads/audio/'.date('Y/m/d/',time());
//            $file_path = 'public/'.$audio_path;
//            if(!File::exists($file_path)){
//                File::makeDirectory($file_path, 0777, true, true);
//            }
//            $filename = str_random(5).'_'.$audio_file->getClientOriginalName();
//            $file = $audio_file->move($file_path, $filename);
//
//            $audio = new Audio();
//            $audio->size = $audio_file->getSize();
//            $audio->path = $audio_path.$filename;
//            $audio->duration;
//            $program->audio()->save($audio);
            $this->saveAudio($program);
        }
        return $this->redirect('album/'.$program->album_id)
            ->withFlashMessage('添加节目成功');

	}

	/**
	 * Display the specified resource.
	 * GET /program/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /program/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $program = Program::find($id);
        if(!Auth::user()->is('admin') && $program->user_id != Auth::user()->id){
            App::abort(403);
        }
        $albums = [];
        $albums['season'] = Album::seasons()->get()->toArray();
        $albums['activity'] = Album::activities()->get()->toArray();


        return $this->view('program.edit')
            ->with('program', $program)
            ->with('albums', $albums);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /program/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        /**
         * @var Program $program
         */
        $program = Program::find($id);
        if(!Auth::user()->is('admin') && $program->user_id != Auth::user()->id){
            App::abort(403);
        }

		$data = Input::all();

        $rules = array(
            'title' => 'required',
            'album_id'=>'required|exists:albums,id',
            'audio' => 'mimes:mpga|max:2048000',//20M
            'user_id'=>'required|exists:users,id',
            'cover' => 'mimes:jpeg,bmp,png|max:1024',//1M
            'thumbnail' => 'mimes:jpeg,bmp,png|max:1024',//1M
            'background' => 'mimes:jpeg,bmp,png|max:4096',//4M
        );
        $message = array(
            'title.required'    => '标题必须!',
            'album_id.required' => '请选择所属分类',
            'album_id.exists'   => '分类不存在',
            'audio.mimes'       => '请上传正确的音频文件',
            'audio.max'         => '音频文件大小应小于 :maxkb',
            'cover.mimes'       => '允许上传的封面图片格式::mimes',
            'cover.max'         => '导图文件大小应小于 :maxkb',
            'thumbnail.mimes'       => '允许上传的缩略图格式::mimes',
            'thumbnail.max'         => '缩略图文件大小应小于 :maxkb',
            'background.mimes'       => '允许上传的背景图格式::mimes',
            'background.max'         => '背景图文件大小应小于 :maxkb'
        );
        $validator = Validator::make($data, $rules, $message);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $program->fill($data);
        if(Input::hasFile('cover')){
            if(!empty($program->cover)){
                File::delete('public/'.$program->cover);
            }
            $program->cover = $this->savePicture('cover');
        }
        if(Input::hasFile('thumbnail')){
            if(!empty($program->thumbnail)){
                File::delete('public/'.$program->thumbnail);
            }
            $program->thumbnail = $this->savePicture('thumbnail');
        }
        if(Input::hasFile('background')){
            if(!empty($program->background)){
                File::delete('public/'.$program->background);
            }
            $program->background = $this->savePicture('background');
        }
        if(!$program->visible){
            $program->visible = 1;
            $contribution = \Contribution::whereProgramId($program->id)->first();
            $contribution->passed_at = new \DateTime();
            $contribution->save();
        }
        $program->save();

        if(Input::hasFile('audio')){
            Audio::whereProgramId($program->id)->delete();
            if(!empty($program->path)){
                File::delete('public/'.$program->path);
            }
            $this->saveAudio($program);
        }
        return $this->redirect('album/'.$program->album_id)
            ->withFlashMessage('修改节目成功');
    }
    private function savePicture($name){
        /**
         * @var UploadedFile $cover_file
         */
        $cover_file = Input::file($name);

        $picture_path = 'uploads/'.$name.'/'.date('Y/m/d/',time());
        $file_path = app_path().'/../public/'.$picture_path;
        if(!File::exists($file_path)){
            File::makeDirectory($file_path, 0777, true, true);
        }
        $filename = str_random(5).'_'.$cover_file->getClientOriginalName();
        $cover_file->move($file_path, $filename);
        return $picture_path.$filename;
    }
    private function saveAudio(Program $program){
        /**
         * @var UploadedFile $audio_file
         */
        $audio_file = Input::file('audio');

        $audio_path = 'uploads/audio/'.date('Y/m/d/',time());
        $file_path = app_path().'/../public/'.$audio_path;
        if(!File::exists($file_path)){
            File::makeDirectory($file_path, 0777, true, true);
        }
        $filename = str_random(5).'_'.$audio_file->getClientOriginalName();
        $audio_file = $audio_file->move($file_path, $filename);
        $audio = new Audio();
        $audio->size = $audio_file->getSize();
        $audio->path = $audio_path.$filename;
        $audio->duration;
        $program->audio()->save($audio);
        return $audio->path;
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /program/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Program::whereId($id)->delete()){
            return Redirect::back()->withFlashMessage('删除成功');
        }
        return Redirect::back()->withFlashMessage('删除失败')->withFlashType('danger');

    }

}